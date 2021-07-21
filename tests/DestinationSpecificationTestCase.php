<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Destination;
use App\Traveler;

final class DestinationSpecificationTestCase extends TestCase
{
    protected $destinations = [];

    protected function setUp(): void
    {
        $this->destinations = [
            'Toronto' => new Destination([24, 25, 33, 43, 54, 63, 69, 69, 61, 50, 41, 29]),
            'Cancun' => new Destination([74, 75, 78, 80, 82, 84, 84, 83, 81, 78, 76]),
        ];
    }

    public function testFindingDestinations()
    {
        $this->assertEquals(2, count($this->destinations));

        $validDestinations = [];
        $vicki = new Traveler;
        $vicki->minTemp = 70;
        $travelDate = mktime(0, 0, 0, 2, 11, 2005);

        $warmEnough = new DestinationRequiredTemperatureSpecification($vicki, $travelDate);

        foreach ($this->destinations as $dest) {
            if ($warmEnough->isSatisfiedBy($dest)) {
                $validDestinations[] = $dest;
            }
        }

        $this->assertEquals(1, count($validDestinations));
        $this->assertIdentical(
            $this->destinations['Cancun'],
            $validDestinations[0]
        );
    }

}