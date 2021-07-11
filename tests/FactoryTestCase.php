<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Color;

final class FactoryTestCase extends TestCase
{
    public function testInstantiate()
    {
        $color = new Color;

        $this->assertInstanceOf(Color::class, $color);
        $this->assertTrue(method_exists($color, 'getRGB'));
    }
    

    public function testGetRGBWhite()
    {
        $white = new Color(255, 255, 255);

        $this->assertEquals('#FFFFFF', $white->getRGB());
    }

    public function testGetRGBRed()
    {
        $red = new Color(255, 0, 0);

        $this->assertEquals('#FF0000', $red->getRGB());
    }

    public function testGetRGBRandom()
    {
        $color = new Color(rand(0, 255), rand(0, 255), rand(0, 255));

        $this->assertRegExp('/^#[0-9A-F]{6}/', $color->getRGB());

        $color2 = new Color($t = rand(0, 255), $t, $t);

        $this->assertRegExp('/^#([0-9A-F]{2})\1\1$/', $color2->getRGB());
    }
    
    public function testColorBundaries()
    {
        $this->expectError();
        
        $color = new Color(-1);

        $this->expectErrorMessageMatches('/out.*0.*255/i');

        $color = new Color(1111);

        $this->expectErrorMessageMatches('/out.*0.*255/i');
    }
}