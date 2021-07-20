<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\ErrorHandler;
use App\Observer;

final class ErrorHandlerTestCase extends TestCase
{
    public function testAttach(): void
    {
        $eh = new ErrorHandler;
        
        $observer = $this->createMock(Observer::class);
        $observer->expect($this->once())->method('update')->with(['*']);

        $eh->attach($observer);
        $eh->notify();

        $observer->tally();

    }

    public function testDetach(): void
    {
        //
    }
}