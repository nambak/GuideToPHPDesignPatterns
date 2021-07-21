<?php declare(strict_types = 1);

namespace App;

class TripRequiredTemperatureSpecification
{
    public function isSatisfiedBy($trip): bool
    {
        $tripTemp = $trip->destination->getAvgTempByMonth(date('m', $trip->date));

        return ($tripTemp >= $trip->traveler->minTemp);
    }
}