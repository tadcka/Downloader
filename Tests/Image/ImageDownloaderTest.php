<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Downloader\Tests\Image;

use Tadcka\Component\Downloader\Image\ImageDownloader;
use Tadcka\Component\Downloader\Tests\AbstractDownloaderTest;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 9:31 PM
 */
class ImageDownloaderTest extends AbstractDownloaderTest
{
    /**
     * @var ImageDownloader
     */
    private $downloader;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->downloader = new ImageDownloader();
    }

    public function testDownload()
    {
        $dirMockFiles = $this->getDirMockFiles();
        $this->assertEqualsFile($dirMockFiles . 'test.png', $this->downloader);
        $this->assertEqualsFile($dirMockFiles . 'test.jpg', $this->downloader);
        $this->assertEqualsFile($dirMockFiles . 'test.gif', $this->downloader);
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\FileNotFoundException
     */
    public function testDownloadFileNotFound()
    {
        $this->assertEqualsFile($this->getDirMockFiles() . 'fake.png', $this->downloader);
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\ImageException
     */
    public function testDownloadFileNotImage()
    {
        $this->assertEqualsFile($this->getDirMockFiles() . 'test.txt', $this->downloader);
    }
}
