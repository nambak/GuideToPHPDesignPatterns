<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Registry;

final class REgistryTestCase extends TestCase
{
    public function testRegistryIsSingleton()
    {
        $this->assertInstanceOf(Registry::class, $reg = Registry::getInstance());
        $this->assertSame($reg, Registry::getInstance());
    }

    public function testEmptyRegistryKeyIsInvalid()
    {
        $reg = Registry::getInstance();
        
        $this->assertFalse($reg->isValid('key'));
    }

    public function testEmptyRgistryKeyReturnsNull()
    {
        $reg = Registry::getInstance();

        $this->assertNull($reg->get('key'));
    }

    public function testSetRegistryKeyBecomesValid()
    {
        $reg = Registry::getInstance();
        $testValue = 'something';
        $reg->set('key', $testValue);

        $this->assertTrue($reg->isValid('key'));
    }

    public function testSetRegistryValueIsReference()
    {
        $reg = Registry::getInstance();
        $testValue = 'something';
        $reg->set('key', $testValue);
        
        $this->assertSame($testValue, $reg->get('key'));

        // another way to test the reference
        $testValue .= ' else';

        $this->assertEquals('something else', $reg->get('key'));
    }
}