<?php declare(strict_types = 1);

namespace App;

class DestinationRequiredTempperatureSpecification
{
    protected $temp;
    protected $month;

    public function __construct($traveler, $date)
    {
        $this->temp = $traveler->minTemp;
        $this->month = date('m', $date);
    }

    public function isSatisfiedBy($destination): bool
    {
        return ($destination->getAvgTempByMonth($this->month) >= $this->temp);
    }
}