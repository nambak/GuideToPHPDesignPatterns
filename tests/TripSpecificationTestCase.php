<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Destination;
use App\Traveler;
use App\Trip;
use App\TripRequiredTemperatureSpecification;

final class TripSpecificationTestCase extends TestCase
{
    protected $destinations = [];

    protected function setUp(): void
    {
        $this->destinations = [
            'Toronto' => new Destination([24, 25, 33, 43, 54, 63, 69, 69, 61, 50, 41, 29]),
            'Cancun' => new Destination([74, 75, 78, 80, 82, 84, 84, 83, 81, 78, 76]),
        ];
    }

    public function testTripTooCold()
    {
        $vicki = new Traveler;
        $vicki->minTemp = 70;
        
        $toronto = $this->destinations['Toronto'];

        $trip = new Trip;
        $trip->traveler = $vicki;
        $trip->destination = $toronto;
        $trip->date = mktime(0, 0, 0, 2, 11, 2005); 

        $warmEnoughCheck = new TripRequiredTemperatureSpecification;

        $this->assertFalse($warmEnoughCheck->isSatisfiedBy($trip));
    }

    public function testTripWarmEnough()
    {
        $vicki = new Traveler;
        $vicki->minTemp = 70;
        
        $cancun = $this->destinations['Cancun'];

        $trip = new Trip;
        $trip->traveler = $vicki;
        $trip->destination = $cancun;
        $trip->date = mktime(0, 0, 0, 2, 11, 2005);

        $warmEnoughCheck = new TripRequiredTemperatureSpecification;

        $this->assertTrue($warmEnoughCheck->isSatisfiedBy($trip));
    }
}