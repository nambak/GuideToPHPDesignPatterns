<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Color;

final class CrayonBoxTestCase extends TestCase
{
    public function testGetColor()
    {
        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('red'));
        $this->assertEquals('#FF0000', $o->getRGB());

        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('LIME'));
        $this->assertEquals('#00FF00', $o->getRGB());
    }

    public function testBadColor()
    {
        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('Lemon'));
        $this->expectError();
        $this->assertErrorMessageMatches('/lemon/i');

        // got black instead
        $this->assertEquals('#000000', $o->getRGB());
    }
}