<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Library;

final class LibraryTestCase extends TestCase
{
    public function testCount()
    {
        $lib = new Library;

        $this->assertEquals(0, $lib->count());
    }

    public function testAdd()
    {
        $lib = new Library;
        $lib->add('one');

        $this->assertEquals(1, $lib->count());
    }
}