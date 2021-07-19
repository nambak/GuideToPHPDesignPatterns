<?php declare(strict_types = 1);

namespace App;

class Lendable
{
    public $status = 'library';
    public $borrower = '';

    public function checkout($borrower): void
    {
        $this->status = 'borrowed';
        $this->borrower = $borrower;
    }

    public function checkin(): void 
    {
        $this->status = 'library';
        $this->borrower = '';
    }
}