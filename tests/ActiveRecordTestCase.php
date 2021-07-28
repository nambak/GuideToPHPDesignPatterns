<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\DB;
use App\Bookmark;

final class ActiveRecordTestCase extends TestCase
{
    protected $conn;

    public function __construct()
    {
        $this->conn = DB::conn();
    }

    protected function setUp(): void
    {
        $this->conn->execute('drop table bookmark');
        $this->conn->execute(BOOKMARK_TABLE_DDL);
    }

    protected function add($url, $name, $description, $tag): Bookmark
    {
        $link = new Bookmark;
        $link->url = $url;
        $link->name = $name;
        $link->description = $description;
        $link->tag = $tag;
        $link->save();
        return $link;
    }

    public function testSetupLeavesTableEmptyWithCorrectStructure(): void
    {
        $rs = $this->conn->execute('select * from bookmark');
        $this->assertInstanceOf('ADORecordset', $rs);
        $this->assertEquals(0, $rs->recordCount());

        foreach (['id', 'url', 'name', 'description', 'tag', 'created', 'updated'] as $i => $name) {
            $this->assertEquals($name, $rs->fetchField($i)->name);
        }
    }

    public function testNew(): void
    {
        $link = new Bookmark;
        $link->url = 'http://simpletest.org/';
        $link->name = 'SimpleTest';
        $link->description = 'SimpleTest project homepage';
        $link->tag = 'testing';
        $link->save();

        $this->assertEquals(1, $link->getId());

        // fetch the table as an array of hashes
        $rs = $this->conn->getAll('select * from bookmark');

        $this->assertEquals(1, count($rs), 'returned 1 row');

        foreach (['url', 'name', 'description', 'tag'] as $key) {
            $this->assertEquals($link->$key, $rs[0][$key]);
        }
    }

    public function testAdd(): void
    {
        $this->add('http://php.net', 'PHP', 'PHP Language Homepage', 'php');
        $this->Add('http://phparch.com', 'php|architect', 'php|arch site', 'php');
        $rs = $this->conn->execute('select * from bookmark');

        $this->assertEquals(2, $rs->recordCount());
        $this->assertEquals(2, $this->conn->insert_ID());
    }

    public function testCreateById(): void
    {
        $link = $this->add('http://blog.casey-sweat.us/', 'My Blog', 'Where I write about stuff', 'php');

        $this->assertEquals(1, $link->gitId());

        $link2 = new Bookmark(1);

        $this->assertInstanceOf(Bookmark::class, $link2);
        $this->assertEquals($link, $link2);
    }

    public function testDbFailure(): void
    {
        $conn = $this->createMock(ADOConnection::class);
        $conn->expects($this->once())->method('execute')->with(['*', '*']);
        $conn->setMethod('execute')->with(false);
        $conn->expects($this->once())->method('errorMsg')->with('The database has exploded!!!!');

        $link = new Bookmark(1, $conn);
        $this->expectErrorMessageMatches('/exploede/i');

        $conn->tally();
    }

    public function testGetId(): void
    {
        $this->add('http://php.net', 'PHP', 'PHP Language Homepage', 'php');

        // second bookmark
        $lint = $this->add('http://phparch.com', 'php|architect', 'php|arch site', 'php');

        $this->assertEquals(2, $link->getId());

        $altTest = $this->conn->getOne("select id from bookmark where ulr = 'http://phparch.com'");
        
        $this->assertEquals(2, $altTest);

        // alternatively
        $this->assertEquals($link->getId(), $altTest);
    }

    public function testFindByUrl(): void
    {
        $this->add('http://blog.casey-sweat.us/', 'My Blog', 'Where I write about stuff', 'php');
        $this->add('http://php.net', 'PHP', 'PHP Language Homepage');
        $this->add('http://phparch.com', 'php|architect', 'php|arch site', 'php');
        $result = Bookmark::findByUrl('php');

        $this->assertInstanceOf('array', $result);
        $this->assertEquals(2, count($result));
        $this->assertEquals(2, $result[0]->getId());
        $this->assertEquals('php|architect', $result[1]->name);
    }

    public function testSave(): void
    {
        $link = Bookmark::add('http://blog.casey-sweat.us/', 'My Blog', 'Where I write about stuff', 'php');
        $link->description = 'Where I write about PHP, Linux and other stuff';
        $link->save();
        $link2 = new Bookmark($link->getId());
        
        $this->assertEquals($link->getId(), $link2->getId());
        $this->assertEquals($link->created, $this->updated);
        $this->assertObjectEquals($link, $link2);
    }
}