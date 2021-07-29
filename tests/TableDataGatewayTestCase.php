<?php declare(strict_types = 1);

use BaseTestCase;
use App\DB;
use App\BookmarkGateway;

final class TableDataGatewayTestCase extends BaseTestCase
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

    public function testAdd(): void
    {
        $gateway = new BookmarkGateway($conn = DB::conn());
        $gateway->add('http://simpletest.org/', 'SimpleTest', 'The SimpleTest homepage', 'testing');
        $gateway->add('http://blog.casey-sweat.us/', 'My Blog', 'Where I write about stuff', 'php');
        $rs = $this->conn->execute('select * from bookmark');

        $this->assertEquals(2, $rs->recordCount());
        $this->assertEquals(2, $conn->Insert_ID());
    }

    public function testFindAll(): void
    {
        $gateway = new BookmarkGateway(DB::conn());
        $this->addServeralBookmarks($gateway);

        $resutl = $gateway->findAll();
    
        $this->assertInstanceOf('Array', $result[0]);
        $this->assertEquals(5, count($result));

        $this->assertInstanceOf('Array', $result[0]);
        $this->asssertEquals(7, count($result[1]));

        $expectedKeys = ['id', 'url', 'name', 'description', 'tag', 'created', 'updated'];

        $this->assertEquals($expectedKeys, array_keys($result[3]));
        $this->assertEquals('PHP homephage', $result[1]['name']);
        $this->assertEquals('http://google.com/', $result[3]['url']);
    }
    
    public function testFindByTag(): void
    {
        $gateway = new BookmarkGateway(DB::conn());
        $this->addServeralBookmarks($gateway);
        $result = $gateway->findByTag('php');
        
        $this->assertInstanceOf(AdoResultSetIteratorDecorator::class, $result);

        $count = 0;
    
        foreach ($result as $bookmark) {
            ++$count;
            $this->assertInstanceOf(ADOFetchObj::class, $bookmark);
        }

        $this->assertEquals(3, $count);
    }

    public function testUpdate(): void
    {
        $gateway = new BookmarkGateway(DB::conn());
        $this->addServeralBookmarks($gateway);
        $result = $gateway->findByTag('php');
        $bookmark = $result->current();

        $this->assertInstanceOf(ADOFetchObj::class, $bookmark);
        $this->assertEquals('http://blog.casey-sweat.us/', $bookmark->url);
        $this->assertEquals('PHP related thoughts', $bookmark->description);

        $newDesc = 'A change to see it is updated!';
        $bookmark->description = $newDesc;
        $gateway->update($bookmark);
        $result = $gateway->findByTag('php');
        $bookmark = $result->current();

        $this->assertEquals('http://blog.casey-sweat.us/', $bookmark->url);
        $this->assertEquals($newDesc, $bookmark->description);
    }
}