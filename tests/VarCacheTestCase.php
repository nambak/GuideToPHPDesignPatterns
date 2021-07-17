<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\VarCache;

final class VarCacheTestCase extends TestCase
{
    protected function setUp(): void
    {
        @unlink('cache/foo.php');
    }

    public function testUnsetValueInvalid()
    {
        $cache = new VarCache('foo');
        
        $this->assertFalse($cache->isValid());
    }

    public function testIsValidTrueAfterSet()
    {
        $cache = new VarCache('foo');
        $cache->set('bar');

        $this->assertTrue($cache->isValid());
    }

    public function testCacheRetainsValue()
    {
        $testVal = 'test' . rand(1, 100);
        $cache = new VarCache('foo');
        $cache->set($testVal);

        $this->assertEquals($testVal, $cache->get());
    }

    public function testStringFailsForArray()
    {
        $this->expectError();

        $testVal = ['one', 'two'];
        $cache = new VarCache('foo');
        $cache->set($testVal);
        
        $this->expectErrorMessage('Array to string conversion');
        $this->assertNotEquals($testVal, $cache->get());
        $this->assertEquals('array', strtolower($cache->get()));
    }
}