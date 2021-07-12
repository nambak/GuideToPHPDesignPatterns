<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\ApplicationConfig;

final class ApplicationConfigTestCase extends TestCase
{
    public function testApplicationConfig()
    {
        $this->assertInstanceOf(ApplicationConfig::class, $obj1 = new ApplicationConfig);
        $this->assertInstanceOf(ApplicationConfig::class, $obj2 = new ApplicationConfig);

        $testVal = '/path/to/cache/' . rand(1, 100);

        $obj1->set('cache_path', $testVal);
        
        $this->assertEquals($testVal, $obj2->get('cache_path'));
    }
}