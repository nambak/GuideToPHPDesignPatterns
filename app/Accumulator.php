<?php declare(strict_types = 1);

namespace App;

class Accumulator
{
    public $total = 0;

    public function add($item): void
    {
        $this->total += $item;
    }

    public function total(): int
    {
        return $this->total;
    }
}