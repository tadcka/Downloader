<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Downloader\Image;

use Symfony\Component\Filesystem\Filesystem;
use Tadcka\Component\Downloader\Exception\ImageException;
use Tadcka\Component\Downloader\File;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 9:26 PM
 */
class ImageDownloader
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * Images extensions.
     *
     * @var array
     */
    private $imageExtensions = array('jpeg', 'jpg', 'png', 'gif');

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->fileSystem = new Filesystem();
    }

    /**
     * Download image.
     *
     * @param string $originFile
     * @param string $downloadFolder
     * @param string|null $name
     *
     * @return File
     *
     * @throws ImageException
     */
    public function download($originFile, $downloadFolder, $name = null)
    {
        if (false === $this->isValidOriginFile($originFile)) {
            throw new ImageException(sprintf('The origin file "%s" is not valid.', $originFile));
        }

        if (null === $name) {
            $name = pathinfo($originFile, PATHINFO_FILENAME);
        }

        $filename = $name . '.' . $this->getFileExtension($originFile);
        $targetFile = rtrim($downloadFolder, '/\\') . DIRECTORY_SEPARATOR . $filename;
        $this->fileSystem->copy($originFile, $targetFile);

        return new File($targetFile);
    }

    /**
     * Check if is valid origin file.
     *
     * @param string $originFile
     *
     * @return bool
     */
    private function isValidOriginFile($originFile)
    {
        return in_array($this->getFileExtension($originFile), $this->imageExtensions);
    }

    /**
     * Get file extension.
     *
     * @param string $file
     *
     * @return string
     */
    private function getFileExtension($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }
}
