<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\PolymorphicForeachableLibrary;

final class PolySplIteratorTestCase extends TestCase
{
    protected $lib;

    protected function setUp(): void
    {
        $this->lib = new PolymorphicForeachableLibrary;
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

    public function testReleasedForeach()
    {
        $this->lib->add(new Media('second', 1999));
        $this->lib->add(new Media('first', 1989));
        $output = [];
        $this->lib->iteratorType('Released');

        foreach ($this->lib as $item) {
            $output[] = $item->name . '-' . $item->year;
        }

        $this->assertEquals('first-1989 second-1999 name1-2000 name3-2001 name2-2002', implode(' ', $output));
    }
}