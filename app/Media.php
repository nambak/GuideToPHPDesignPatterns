<?php declare(strict_types = 1);

namespace App;

class Media extends Lendable
{
    public $name;
    public $type;
    public $year;

    public function __construct($name, $year, $type = 'dvd')
    {
        $this->name = $name;
        $this->type = $type;
        $this->year = (int) $year;
    }
}