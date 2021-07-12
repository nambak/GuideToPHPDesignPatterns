<?php declare(strict_types = 1);

namespace App;

use App\Dollar;

class RailRoad extends Property
{
    protected function calcRent()
    {
        switch ($this->game->railRoadCount($this->owner)) {
            case 1:
                return new Dollar(25);
            case 2:
                return new Dollar(50);
            case 3:
                return new Dollar(100);
            case 4:
                return new Dollar(200);
            default:
                return newDollar;
        }
    }
}