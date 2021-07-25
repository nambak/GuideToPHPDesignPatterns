<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\HwLib;
use App\HwLibGofAdapter;
use App\HwLibV2ToV1Adapter;

final class AdapterTestCase extends TestCase
{
    public function testOriginalApp(): void
    {
        $lib = new HwLib;
        
        $this->assertEquals('Hello World!', $lib->hello() . $lib->world());
    }

    public function testOriginalAppWouldFail(): void
    {
        $lib = new HwLib;   // now using HwLib version 2

        $this->assertFalse(method_exists($lib, 'hello'));
    }

    public function testOriginalAppWithAdapter(): void
    {
        $lib = new HwLibV2ToV1Adapter(new HwLib);

        $this->assertEquals('Greetings and Salutations World!', $lib->hello() . $lib->world());
    }

    public function testAppWithFactory(): void
    {
        $lib = $this->hwLibInstance();

        $this->assertStringMatchesFormat('/\w+ World!$/', $lib->hello() . $lib->world());
    }

    public function testHwLibGofAdapter(): void
    {
        $lib = new HwLibGofAdapter;

        $this->assertEquals('Greetings and Salutations World!', $lib->hello() . $lib->world());
    }

    protected function hwLibInstance($ver = false)
    {   
        switch ($ver) {
            case 'v3':
                return new HwLib;
            case 'v2':
                return new HwLibV3ToV2Adapter(new HwLib);
            default:
                return new HwLibV2ToV1Adapter(new HwLib);
        }
    }
}