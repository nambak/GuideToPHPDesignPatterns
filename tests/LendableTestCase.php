<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Lendable;

final class LendableTestCase extends TestCase
{
    public function testCheckout()
    {
        $item = new Lendable;
        
        $this->assertFalse($item->borrower);

        $item->checkout('John');

        $this->assertEquals('borrowed', $item->status);
        $this->assertEquals('John', $item->borrower);
    }

    public function testCheckin()
    {
        $item = new Lendable;
        $item->checkout('John');
        $item->checkin();

        $this->assertEquals('library', $item->status);
        $this->assertFalse($item->borrower);
    }
}