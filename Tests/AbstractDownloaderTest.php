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

use Symfony\Component\Filesystem\Filesystem;
use Tadcka\Component\Downloader\File;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/30/14 11:42 AM
 */
abstract class AbstractDownloaderTest extends \PHPUnit_Framework_TestCase
{
    protected function assertEqualsFile($originFile, $downloader)
    {
        $this->assertEquals(new File($originFile), $downloader->download($originFile, $this->getFilePath()));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $filesystem = new Filesystem();
        $filesystem->remove($this->getFilePath());
    }

    private function getFilePath()
    {
        return dirname(__FILE__) . '/tmp';
    }

    /**
     * @return string
     */
    protected function getDirMockFiles()
    {
        return dirname(__FILE__) . '/MockFiles/';
    }
}
