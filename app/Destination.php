<?php declare(strict_types = 1);

namespace App;

class Destination
{
    protected $avgTemps;

    public function __construct($avgTemps)
    {
        $this->avgTemps = $avgTemps;
    }

    public function getAvgTempByMonth($month)
    {
        $key = (int) $month - 1;

        if (array_key_exists($key, $this->avgTemps)) {
            return $this->avgTemps[$key];
        }
    }
}