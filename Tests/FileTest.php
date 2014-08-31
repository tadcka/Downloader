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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 8/27/14 10:25 PM
 */
class FileTest extends AbstractDownloaderTest
{
    public function testMoveWithoutName()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move($this->getTmpMoveDir(), null, true);

        $this->assertTrue($this->filesystem->exists($file));
        $this->assertEquals('txt', $file->getExtension());
    }

    public function testMoveWithFilename()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move($this->getTmpMoveDir(), 'new_Test-09');

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

        $file->move($this->getTmpMoveDir(), 'new_Žęėčęė');
    }

    /**
     * @expectedException \Symfony\Component\Filesystem\Exception\IOException
     */
    public function testMoveWithOverrideFalse()
    {
        $filePath = $this->createTempFile('test.txt');
        $file = $this->createFile($filePath);

        $this->assertEquals('txt', $file->getExtension());

        $file = $file->move($this->getTmpMoveDir(), null, false);
        $file->move($this->getTmpMoveDir(), null, false);
    }

    private function createTempFile($filename)
    {
        $filePath = $this->tmpDir . $filename;
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
        return new File($this->filesystem, $filePath);
    }

    /**
     * @return string
     */
    private function getTmpMoveDir()
    {
        return $this->tmpDir . '/move';
    }
}
