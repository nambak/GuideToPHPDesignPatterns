<?php declare(strict_types = 1);

namespace App;

use App\Dollar;
use App\Monopoly;

abstract class Property
{
    protected $name;
    protected $price;
    protected $game;

    public function __construct(Monopoly $game, $name, $price)
    {
        $this->game = $game;
        $this->name = $name;
        $this->price = new Dollar($price);
    }

    abstract protected function calcRent();

    public function purchase($player): void
    {
        $player->pay($this->price);
        $this->owner = $player;
    }

    public function rent($player): void
    {
        if ($this->owner && $this->owner !== $player) {
            $this->owner->collect($player($this->calcRent()));
        }
    }
}