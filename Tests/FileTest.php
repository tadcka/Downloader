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
 * @since 8/27/14 10:25 PM
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->filesystem = new Filesystem();
    }

    public function testMoveWithoutName()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move(dirname(__FILE__) . '/tmpe/', null, true);

        $this->assertTrue($this->filesystem->exists($file));
        $this->assertEquals('txt', $file->getExtension());
    }

    public function testMoveWithFilename()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move(dirname(__FILE__) . '/tmpe/', 'new_Test-09');

        $this->assertTrue($this->filesystem->exists($file));
        $this->assertEmpty($file->getExtension());
    }

    /**
     * @expectedException \Tadcka\Component\Downloader\Exception\FileException
     */
    public function testMoveWithNotValidFilename()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file->move(dirname(__FILE__) . '/tmpe/', 'new_Žęėčęė');
    }

    /**
     * @expectedException \Symfony\Component\Filesystem\Exception\IOException
     */
    public function testMoveWithOverrideFalse()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move(dirname(__FILE__) . '/tmpe/', null, false);
        $file->move(dirname(__FILE__) . '/tmpe/', null, false);
    }

    private function createTempFile($filename)
    {
        $filePath = dirname(__FILE__) . '/tmp/' . $filename;
        $this->filesystem->dumpFile($filePath, 'test');

        return $filePath;
    }

    /**
     * Create file.
     *
     * @param string $filePath
     *
     * @return File
     */
    private function createFile($filePath)
    {
        return new File($filePath);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $dirname = dirname(__FILE__);
        $this->filesystem->remove(array($dirname . '/tmp/', $dirname . '/tmpe/'));
    }
}
