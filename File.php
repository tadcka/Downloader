<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Downloader;

use Symfony\Component\Filesystem\Filesystem;
use Tadcka\Component\Downloader\Exception\FileException;
use Tadcka\Component\Downloader\Exception\FileNotFoundException;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 10:05 PM
 */
class File extends \SplFileInfo
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * Construct.
     *
     * @param Filesystem $fileSystem
     * @param string $path
     * @param bool $checkPath
     *
     * @throws FileNotFoundException
     */
    public function __construct(Filesystem $fileSystem, $path, $checkPath = true)
    {
        if ($checkPath && !is_file($path)) {
            throw new FileNotFoundException($path);
        }

        $this->fileSystem = $fileSystem;

        parent::__construct($path);
    }

    /**
     * Returns the extension of the file.
     *
     * \SplFileInfo::getExtension() is not available before PHP 5.3.6
     *
     * @return string
     */
    public function getExtension()
    {
        return pathinfo($this->getBasename(), PATHINFO_EXTENSION);
    }

    /**
     * Move file.
     *
     * @param string $directory
     * @param null|string $name
     * @param bool $overwrite
     *
     * @return File
     */
    public function move($directory, $name = null, $overwrite = false)
    {
        $targetFile = $this->getTargetFile($directory, $name);
        $this->fileSystem->rename($this->getPathname(), $targetFile, $overwrite);
        $this->fileSystem->chmod($targetFile, 0666, umask());

        return $targetFile;
    }

    /**
     * Get target file.
     *
     * @param string $directory
     * @param null|string $name
     *
     * @return File
     *
     * @throws FileException
     */
    protected function getTargetFile($directory, $name = null)
    {
        if ((null !== $name) && (false === $this->isValidFilename($name))) {
            throw new FileException(
                sprintf('The file name "%s" is not valid. The file can only contain "a-z", "0-9", "-" and "_".', $name)
            );
        }

        $this->fileSystem->mkdir($directory);

        $target = rtrim($directory, '/\\') . DIRECTORY_SEPARATOR . (null === $name ? $this->getBasename() : $name);

        return new File($this->fileSystem, $target, false);
    }

    /**
     * Check if is valid filename.
     *
     * @param string $filename
     *
     * @return bool
     */
    private function isValidFilename($filename)
    {
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        if (preg_match('/^[A-Za-z0-9-_]+$/', $filename)) {
            return true;
        }

        return false;
    }
}
