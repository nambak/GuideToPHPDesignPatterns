<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Color;
use App\CrayonBox;

final class CrayonBoxTestCase extends TestCase
{
    public function testGetColor()
    {
        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('red'));
        $this->assertEquals('#FF0000', $o->getRGB());

        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('LIME'));
        $this->assertEquals('#00FF00', $o->getRGB());
    }

    public function testErrorBadColor()
    {
        $this->expectError();
        $this->assertInstanceOf(Color::class, $o = CrayonBox::getColor('Lemon'));
        $this->assertErrorMessageMatches('/lemon/i');

        // got black instead
        $this->assertEquals('#000000', $o->getRGB());
    }
}