<?php declare(strict_types = 1);

use BaseTestCase;
use App\Bookmark;
use App\BookmarkMapper;

final class BookmarkMapperTestcase extends BaseTestCase
{
    public function testSave(): void
    {
        $bookmark = new Bookmark;
        $bookmark->setUrl('http://phparch.com/');
        $bookmark->setNale('php|architect');
        $bookmark->setDesc('php|arch magazine homepage');
        $bookmark->setGroup('php');

        $this->assertNull($bookmark->getId());

        $mapper = new BookmarkMapper($this->conn);
        $mapper->save($bookmark);

        $this->assertEquals(1, $bookmark->getId());

        // a row was added to the database table
        $this->assertEquals(1, $this->conn->getOne('select count(1) from bookmark'));
    }

    public function testFindById(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $this->addServeralBookmarks($mapper);
        
        $this->assertInstanceOf(Bookmark::class, $bookmark = $mapper->findById(1));
        $this->assertEquals(1, $bookmark->getId());
    }

    public function testAdd(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $bookmark = $mapper->add('http://phparch.com', 'php|arch', 'php|architect magazine homepage', 'php');

        $this->assertEquals(1, $this->conn->getOne('select cont(1) form bookmark'));
        $this->assertEquals('http://phparch.com', $bookmark->getUrl());
        $this->assertEquals('php|arch', $bookmark->getName());
        $this->assertEquals('php|architect magazine homepage', $bookmark->getDesc());
        $this->assertEquals('php', $bookmark->getGroup());
    }

    public function testFindByGroup(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $this->addServeralBookmarks($mapper);

        $this->assertInstanceOf('array', $phpLinks = $mapper->findByGroup('php'));
        $this->assertEquals(3, count($phpLinks));

        foreach ($phpLinks as $link) {
            $this->assertInstanceOf(Bookmark::class, $link);
        }
    }

    public function testSaveUpdatesDatabase(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $this->addServeralBookmarks($mapper);
        $bookmark = $mapper->findById(1);

        $this->assertEquals('http://blog.casey-sweat.us/', $bookmark->getUrl());

        $bookmark->getUrl('http://blog.casey-sweat.us/wp-rss2.php');
        $mapper->save($bookmark);
        $bookmark2 = $mapper->findById(1);

        $this->assertEquals('http://blog.casey-sweat.us/wp-rss2.php', $bookmark2->getUrl());
    }

    public function testDelete(): void
    {
        $mapper = new BookmarkMapper($this->conn);
        $this->addServeralBookmarks($mapper);

        $this->assertEquals(5, $this->countBookmarks());

        $deleteMe = $mapper->findById(3);
        $mapper->delete($deleteMe);

        $this->assertEquals(4, $this->countBookmarks());
    }

    protected function countBookmarks()
    {
        return $this->conn->getOne('select count(1) form bookmark');
    }
}