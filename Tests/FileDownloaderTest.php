<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Downloader\Tests;

use Tadcka\Component\Downloader\FileDownloader;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/30/14 11:17 AM
 */
class FileDownloaderTest extends AbstractDownloaderTest
{
    /**
     * @var FileDownloader
     */
    private $downloader;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->downloader = new FileDownloader();
    }

    public function testDownload()
    {
        $dirMockFiles = $this->getDirMockFiles();
        $this->assertEqualsFile($dirMockFiles . 'test.png', $this->downloader);
        $this->assertEqualsFile($dirMockFiles . 'test.txt', $this->downloader);
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\FileNotFoundException
     */
    public function testDownloadFileNotFound()
    {
        $this->assertEqualsFile($this->getDirMockFiles() . 'fake.txt', $this->downloader);
    }
}
