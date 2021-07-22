<?php declare(strict_types = 1);

namespace App;

use App\Subject;

class ProxySubject
{
    public $subject;

    public function __construct()
    {
        $this->subject = new Subject;
    }

    public function someMethod()
    {
        $this->subject->someMethod();
    }
}