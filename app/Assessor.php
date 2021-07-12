<?php declare(strict_types = 1);

namespace App;

use App\Monopoly;
use App\InvalidPropertyNameException;

class Assessor
{
    protected $game;
    protected $propInfo = [
        // streets
        'Mediterranean Ave.' => ['Street', 60, 'Purle', 2],
        'Baltic Ave.' => ['Street', 60, 'Purple', 2],
        // more of the streets...
        'Boardwalk' => ['Street', 400, 'Blue', 50],
        // railroads
        'Short Line R.R.' => ['RailRoad', 200],
        // the rest of the railroads...
        // utilites
        'Electric Company' => ['Utility', 150],
        'Water Works' => ['Utility', 150]
    ];
    
    public function setGame(Monopoly $game)
    {
        $this->game = $game;
    }

    public function getProperty($name)
    {
        $propInfo = $this->getPropInfo($name);

        switch ($propInfo->type) {
            case 'Street':
                $prop = new Street($this->game, $name, $propInfo->price);
                $prop->color = $propInfo->color;
                $prop->setRent($propInfo->rent);

                return $prop;
            case 'RailRoad':
                return new RailRoad($this->game, $name, $propInfo->price);
            case 'Utility':
                return new Utility($this->game, $name, $propInfo->price);
            default:
                // should not be able to get here
        }
    }

    protected function getPropInfo($name)
    {
        if (!array_key_exists($name, $this->propInfo)) {
            throw new InvalidPropertyNameException($name);
        }

        return new PropertyInfo($this->propInfo[$name]);
    }
}