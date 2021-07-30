<?php declare(strict_types = 1);

use BaseTestCase;
use App\Bookmark;
use App\BookmarkMapper;

final class BookmarkTestCase extends BaseTestCase
{
    public function testAccessorsAndMutators(): void
    {
        $bookmark = new Bookmark(false);
        $props = ['Url', 'Name', 'Desc', 'Group', 'CrtTime', 'ModTime'];

        foreach ($props as $prop) {
            $getProp = "get{$prop}";
            $setProp = "set{$prop}";
            
            $this->assertNull($bookmark->$getProp());

            $val1 = 'some_val';
            $bookmark->$setProp($val1);

            $this->assertEquals($val1, $bookmark->$getProp());

            $val2 = 'other_val';
            $bookmark->$setProp($val2);

            $this->assertNotEquals($val1, $bookmark->$getProp());
            $this->assertEquals($val2, $bookmark->$getProp());
        }

    }

    public function testBadGetSetException(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $this->addServeralBookmarks($mapper);
        $bookmark = $mapper->findById(1);

        $this->expectError();

        try {
            $this->assertNull($bookmark->getFoo());
            $this->expectErrorMessage('no exception thrown');
        } catch (Exception $e) {
            $this->expectErrorMessageMatches('/undefined.*getfoo/i', $e->getMessae());
        }

        try {
            $this->assertNull($bookmark->setFoo('bar'));
            $this->expectErrorMessage('no exception thrown');
        } catch (Exception $e) {
            $this->expectErrorMessageMatches('/undefined.*setfoo/i', $e->getMessage());
        }
    }

    public function testUnsetIdIsNull(): void
    {
        $bookmark = new Bookmark;
        $this->assertNull($bookmark->getId());
    }

    public function testIdOnlySetOnce(): void
    {
        $bookmark = new Bookmark;
        $id = 10;   // just a random value we picked
        $bookmark->setId($id);
        
        $this->assertEquals($id, $bookmark->getId());
        
        $anotherId = 20;    // another random value, != $id
        
        // state the obious
        $this->assertNotEquals($id, $anotherId); 

        $bookmark->setId($anotherId);

        // still the old id
        $this->assertEquals($id, $bookmark->getId());
    }

    public function testFetch(): void
    {
        $bookmark = new Bookmark;
        $bookmark->setUrl('http://www.google.com/');
        $page = $bookmark->fetch();

        $this->assertStringMatchsFormat('~<input[^>]*name=q[^>]*>~im', $page);
    }
}