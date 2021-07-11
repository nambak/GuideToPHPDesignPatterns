<?php declare(strict_types = 1); 

namespace App;

class Monopoly
{
    protected $goAmount;

    /**
     * game constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->goAmount = new Dollar(200);
    }

    /**
     * pay a player for passing "go"
     * 
     * @param Player $player    the player to pay
     * @return void
     */
    public function passGo(Player $player): void
    {
        $player->collect($this->goAmount);
    }

    /**
     * pay rent from one player to another
     * 
     * @param Player $from  the player paying rent
     * @param Player $to    the player collecting rent
     * @param Dollar $rent  the amount of the rent
     * @return void
     */
    public function payRent(Player $from, Player $to, Dollar $rent)
    {
        $to->collect($from->pay($rent));
    }
}