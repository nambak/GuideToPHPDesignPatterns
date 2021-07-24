<?php declare(strict_types = 1);

namespace App;

use App\Widget;

class TextInput extends Widget
{
    public $name;
    public $value;

    public function __construct($name, $value = '')
    {
        $this->name = $name;
        $this->value = $value;        
    }

    protected function asHTML(): string
    {
        return "<input type=\"text\" name=\"{$this->name}\" value=\"{$this->value}\">";
    }
}