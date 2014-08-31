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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/31/14 4:49 PM
 */
abstract class AbstractDownloaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $tmpDir;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->tmpDir = sys_get_temp_dir() . '/sf2';
        $this->filesystem = new Filesystem();
        $this->filesystem->remove($this->tmpDir);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->filesystem->remove($this->tmpDir);
    }

    /**
     * @return string
     */
    protected function getMockFilesDir()
    {
        return dirname(__FILE__) . '/MockFiles/';
    }
}
