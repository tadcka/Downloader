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

use Tadcka\Component\Downloader\File;
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
        parent::setUp();

        $this->downloader = new ImageDownloader($this->filesystem);
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\FileNotFoundException
     */
    public function testDownloadFileNotFound()
    {
        $this->assertEqualsFile($this->getMockFilesDir() . 'fake.png');
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\ImageException
     */
    public function testDownloadFileNotImage()
    {
        $this->assertEqualsFile($this->getMockFilesDir() . 'test.txt');
    }

    public function testDownload()
    {
        $mockFilesDir = $this->getMockFilesDir();
        $this->assertEqualsFile($mockFilesDir . 'test.png');
        $this->assertEqualsFile($mockFilesDir . 'test.jpg');
        $this->assertEqualsFile($mockFilesDir . 'test.gif');
    }

    protected function assertEqualsFile($originFile)
    {
        $this->assertEquals(
            new File($this->filesystem, $originFile),
            $this->downloader->download($originFile, $this->tmpDir)
        );
    }
}
