<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\RegistryGlobal;
use App\RegistryMonoState;

final class RegistryGlobalTestCase extends TestCase
{
    public function testRegistryGlobal()
    {
        $reg = new RegistryGlobal;
        
        $this->assertFalse($reg->isValid('key'));
        $this->assertNull($reg->get('key'));

        $testValue = 'something';
        $reg->set('key', $testValue);

        $this->assertSame($testValue, $reg->get('key'));
    }

    public function testRegistryMonoState()
    {
        $this->assertEquals($reg = new RegistryMonoState, $reg2 = new RegistryMonoState);
        $this->assertFalse($reg->isValid('key'));
        $this->assertNull($reg->get('key'));

        $testValue = new StdClass;
        $reg->set('key', $testValue);

        $this->assertSame($testValue, $reg2->get('key'));
    }
}