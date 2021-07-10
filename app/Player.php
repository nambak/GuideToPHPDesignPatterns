<?php declare(strict_types = 1);

namespace App;

use App\Dollar;

class Player
{
    protected $name;
    protected $savings;

    /**
     * constructor
     * 
     * set name and initial balance
     * 
     * @param string $name  the players name
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->savings = new Dollar(1500);
    }

    /**
     * receive a payment
     * 
     * @param Dollar $amount    the amount received
     * @return void
     */
    public function collect(Dollar $amount): void
    {
        $this->savings = $this->savings->add($amount);
    }

    /**
     * return a player balance
     * 
     * @return float
     */
    public function getBalance(): float
    {
        return $this->savings->getAmount();
    }
}