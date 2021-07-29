<?php declare(strict_types = 1);

use BaseTestCase;
use App\BookmarkGateway;

final class AdoResultSetIteratorDecoratorTestCase extends BaseTestCase
{
    public function testADOdbDecorator(): void
    {
        $gateway = new BookmarkGeteway($this->conn);
        $this->addServeralBookmarks($gateway);
        $rs = $this->conn->execute('select * from bookmark');

        foreach ($rs as $row) {
            $this->assertInstanceOf('array', $row);
            $this->assertInstanceOf(ADOFetchObj::class, $rs->fetchObj());
        }
    }

    public function testRsDecorator(): void
    {
        $gateway = new BookmarkGateway($this->conn);
        $this->addServeralBookmarks($gateway);
        $rs = $this->conn->execute('select * from bookmark');
        $count = 0;

        foreach (new AdoResultSetIteratorDecorator($rs) as $bookmark) {
            ++$count;
            
            $this->assertInstanceOf(ADOFetchObj::class, $bookmark);
            $this->assertTrue($bookmark->id > 0);
            $this->assertTrue(strlen($bookmark->url) > 10);
        }

        $this->assertEquals(5, $count);
    }
}

