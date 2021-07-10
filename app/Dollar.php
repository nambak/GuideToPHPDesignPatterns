<?php declare(strict_types = 1);

namespace App;

class Dollar
{
    protected $amount;

    public function __construct($amount = 0)
    {
        $this->amount = (float) $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function add(Dollar $dollar): Dollar
    {
        return new Dollar($this->amount + $dollar->getAmount());
    }
}