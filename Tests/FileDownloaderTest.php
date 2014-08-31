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

use Tadcka\Component\Downloader\File;
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
        parent::setUp();

        $this->downloader = new FileDownloader($this->filesystem);
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\FileNotFoundException
     */
    public function testDownloadFileNotFound()
    {
        $this->assertEqualsFile($this->getMockFilesDir() . 'fake.txt');
    }

    public function testDownload()
    {
        $mockFilesDir = $this->getMockFilesDir();
        $this->assertEqualsFile($mockFilesDir . 'test.png');
        $this->assertEqualsFile($mockFilesDir . 'test.txt');
    }

    protected function assertEqualsFile($originFile)
    {
        $this->assertEquals(
            new File($this->filesystem, $originFile),
            $this->downloader->download($originFile, $this->tmpDir)
        );
    }
}
