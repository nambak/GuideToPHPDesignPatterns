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

    public function testCalcTax()
    {
        $amount = $this->createMock(Accumulator::class);
        $amount->setReturnValue('total', 200);
        $amount->expectOnce('total');

        $this->assertEquals(14,  cal_tax($amount));

        $amount->tally();
    }

    public function testCalcTotalAgain()
    {
        $sum = $this->createMock(Accumulator::class);
        $sum->expectOnce('add');

        calc_total([1, 2, 3], $sum);

        $sum->tally();
    }
}