<?php declare(strict_types = 1);

namespace App;

class HwLibV2ToV1Adapter
{
    public $libV2;

    public function __construct($libV2)
    {
        $this->libV2 = $libV2;
    }

    public function hello()
    {
        return $this->libV2->greet();
    }

    public function world()
    {
        return $this->libV2->world();
    }
}