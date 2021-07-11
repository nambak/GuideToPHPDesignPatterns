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

    public function add(Dollar $dollar)
    {
        return new Dollar($this->amount + $dollar->getAmount());
    }

    public function debit(Dollar $dollar)
    {
        return new Dollar($this->amount - $dollar->getAmount());
    }

    public function divide($divisor): array
    {
        $ret = [];
        $alloc = round($this->amount / $divisor, 2);
        $commAlloc = 0.0;

        foreach (range(1, $divisor - 1) as $i) {
            $ret[] = new Dollar($alloc);
            $commAlloc += $alloc;
        }

        $ret[] = new Dollar(round($this->amount - $commAlloc, 2));

        return $ret;
    }
}