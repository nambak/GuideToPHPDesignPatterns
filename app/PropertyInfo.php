<?php declare(strict_types = 1);

namespace App;

class PropertyInfo
{
    const TYPE_KEY = 0;
    const PRICE_KEY = 1;
    const COLOR_KEY = 2;
    const RENT_KEY = 3;

    public $type;
    public $price;
    public $color;
    public $rent;
    
    public function __construct($props)
    {
        $this->type = $this->propValues($props, 'type', self::TYPE_KEY);
        $this->price = $this->propValues($props, 'price', self::PRICE_KEY);
        $this->color = $this->propValues($props, 'color', self::COLOR_KEY);
        $this->rent = $this->propValues($props, 'rent', self::RENT_KEY);
    }

    protected function propValues($props, $prop, $key)
    {
        if (array_key_exists($key, $props)) {
            return $this->$prop = $props[$key];
        }
    }
}