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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 9:26 PM
 */
class FileDownloader
{
    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * Constructor.
     *
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * Download file.
     *
     * @param string $originFile
     * @param string $downloadFolder
     * @param string|null $name
     *
     * @return File
     */
    public function download($originFile, $downloadFolder, $name = null)
    {
        if (null === $name) {
            $name = pathinfo($originFile, PATHINFO_FILENAME);
        }

        $filename = $name . '.' . $this->getFileExtension($originFile);
        $targetFile = rtrim($downloadFolder, '/\\') . DIRECTORY_SEPARATOR . $filename;
        $this->fileSystem->copy($originFile, $targetFile);

        return new File($this->fileSystem, $targetFile);
    }

    /**
     * Get file extension.
     *
     * @param string $file
     *
     * @return string
     */
    protected function getFileExtension($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }
}
