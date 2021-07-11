<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Dollar;

final class ValueObjectsTestCase extends TestCase
{
    public function testDollarDivideReturnsArrayOfDivisorSize(): void
    {
        $fullAmount = new Dollar(8);
        $parts = 4;

        $this->assertIsArray($result = $fullAmount->divide($parts));
        $this->assertEquals($parts, count($result));
    }

    public function testDollarDrivesEquallyForExactMultiple(): void
    {
        $testAmount = 1.25;
        $parts = 4;

        $dollar = new Dollar($testAmount * $parts);

        foreach ($dollar->divide($parts) as $part) {
            $this->assertInstanceOf(Dollar::class, $dollar);
            $this->assertEquals($testAmount, $part->getAmount());
        }
    }

    public function testDollaDivideImmuneToRoundingErrors()
    {
        $testAmount = 7;
        $parts = 3;

        $this->assertNotEquals(
            round($testAmount / $parts, 2), 
            $testAmount / $parts, 
            'Make sure we are testing a non-trivial case %s'
        );

        $total = new Dollar($testAmount);
        $lastAmount = false;
        $sum = new Dollar(0);

        foreach ($total->divide($parts) as $part) {
            if ($lastAmount) {
                $difference = abs($lastAmount - $part->getAmount());

                $this->assertTrue($difference <= 0.01);
            }

            $lastAmount = $part->getAmount();
            $sum = $sum->add($part);
        }

        $this->assertEquals($sum->getAmount(), $testAmount);
    }
}