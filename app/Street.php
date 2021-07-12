<?php declare(strict_types = 1);

namespace App;

use App\Property;
use App\Dollar;

class Street extends Property
{
    protected $baseRent;
    public $color;
    
    public function setRent($rent): void
    {
        $this->baseRend = new Dollar($rent);
    }

    protected function clacRent() 
    {
        if ($this->game->hasMonopoly($this->owner, $this->color)) {
            return $this->baseRent->add($this->baseRent);;
        }

        return $this->baseRent;
    }
}
