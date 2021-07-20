<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\ForeachableLibrary;
use App\Media;

final class SplIteratorTestCase extends TestCase
{
    protected $lib;

    protected function setUp(): void
    {
        $this->lib = new ForeachableLibrary;
        $this->lib->add(new Media('name1', 2000));
        $this->lib->add(new Media('name2', 2002));
        $this->lib->add(new Media('name3', 2001));
    }

    public function testForeach()
    {
        $output = '';

        foreach ($this->lib as $item) {
            $output .= $item->name;
        }

        $this->assertEquals('name1name2name3', $output);
    }
}