<?php declare(strict_types = 1); 

namespace App;

class GenericProxy
{
    protected $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->subject, $method], $args);
    }
}