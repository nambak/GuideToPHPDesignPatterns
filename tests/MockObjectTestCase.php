<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Accumulator;

final class MockObjectTestCase extends TestCase
{
    public function testCalcTotal()
    {
        $sum = new Accumulator;
        calc_total([1, 2, 3], $sum);

        $this->assertEquals(6, $sum->total());
    }

    public function testCalc
}