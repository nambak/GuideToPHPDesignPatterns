<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\DbConn;

final class SingletonTestCase extends TestCase
{
    public function testGetInstance()
    {
        $this->assertInstanceOf(DbConn::class, $obj1 = DbConn::getInstance());
        $this->assertSame($obj1, $obj2 = DbConn::getInstance(), 'Two calls to getInstance() return the same objects');   
    }

    public function testBadInstantiate()
    {
        $this->expectError();
        
        $obj = new DbConn;
        
        $this->assertErrorMessageMatches('/(bad|nasty|evil|do not|don\'t|warn).*(instance|create|new|direct)/i');
    }
}