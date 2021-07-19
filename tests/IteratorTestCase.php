<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Library;
use App\Media;
use App\LibraryGofIterator;
use App\LibraryIterator;

final class IteratorTestCase extends TestCase
{
    protected $lib;

    protected function setUp(): void
    {
        $this->lib = new Library;
        $this->lib->add(new Media('name1', 2000));
        $this->lib->add(new Media('name2', 2002));
        $this->lib->add(new Media('name3', 2001));
    }

    public function testGetGofIterator()
    {
        $this->assertInstanceOf(LibraryGofIterator::class, $it = $this->lib->getIterator());
        $this->assertFalse($it->isDone());
        $this->assertInstanceOf(Media::class, $first = $it->currentItem());
        $this->assertEquals('name1', $first->name);
        $this->assertFalse($it->isDone());

        $this->assertTrue($it->next());
        $this->assertInstanceOf(Media::class, $second = $it->currentItem());
        $this->assertEquals('name2', $second->name);
        $this->assertFalse($it->isDone());

        $this->assertTrue($it->next());
        $this->assertInstanceOf(Media::class, $third = $it->currentItem());
        $this->assertEquals('name3', $third->name);
        $this->assertFalse($it->next());
        $this->assertTrue($it->isDone());
    }

    public function testGofIteratorUsage()
    {
        $output = '';

        for ($it = $this->lib->getIterator(); !$it->isDone(); $it->next()) {
            $output .= $it->currentItem()->name;
        }

        $this->assertEquals('name1name2name3', $output);
    }
    
    public function testMediaIteratorUsage() {
        $this->assertInstanceOf(LibraryIterator::class, $it = $this->lib->getIterator('media'));

        $output = '';

        while ($item = $it->next()) {
            $output .= $item->name;
        }
        
        $this->assertEquals('name1name2name3', $output);
    }
}