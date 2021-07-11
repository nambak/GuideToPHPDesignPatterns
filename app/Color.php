<?php declare(strict_types = 1);

namespace App;

class Color
{
    private $r = 0;
    private $g = 0;
    private $b = 0;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->r = $this->validateColor($red);
        $this->g = $this->validateColor($green);
        $this->b = $this->validateColor($blue);
    }
    
    public function getRGB(): string
    {
        return sprintf('#%02X%02X%02X', $this->r, $this->g, $this->b);
    }

    private function validateColor($color)
    {
        $check = (int) $color;

        if ($check < 0 || $check > 255) {
            trigger_error("color '$color' out of bounds, please specify a number between 0 and 255");
        } else {
            return $check;
        }
    }
}