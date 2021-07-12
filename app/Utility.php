<?php declare(strict_types = 1);

namespace App;

use App\Dollar;

class Utility extends Property
{
    protected function calcRent()
    {
        switch ($this->game->utilityCount($this->owner)) {
            case 1:
                return new Dollar(4 * $this->game->lastRoll());
            case 2:
                return new Dollar(10 * $this->game->lastRoll());
            default:
                return new Dollar();
        }
    }
}