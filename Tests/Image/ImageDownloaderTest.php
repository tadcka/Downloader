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

use Symfony\Component\Filesystem\Filesystem;
use Tadcka\Component\Downloader\File;
use Tadcka\Component\Downloader\Image\ImageDownloader;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 9:31 PM
 */
class ImageDownloaderTest extends \PHPUnit_Framework_TestCase
{
    public function testDownload()
    {
        $downloader = new ImageDownloader();
        $originFile = dirname(__FILE__) . '/../MockFiles/test.png';
        $file = $downloader->download($originFile, $this->getFilePath());

        $this->assertEquals(new File($originFile), $file);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $filesystem = new Filesystem();
        $filesystem->remove(array(dirname(__FILE__) . '/../tmp'));
    }

    private function getFilePath()
    {
        return dirname(__FILE__) . '/../tmp';
    }
}
