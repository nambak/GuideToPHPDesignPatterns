<?php declare(strict_types = 1);

namespace App;

class UserLogin
{
    private $valid = true;
    private $id;
    private $name;

    public function __construct($name)
    {
        switch (strtolower($name)) {
            case 'admin':
                $this->id = 1;
                $this->name = 'admin';
                break;
            default:
                trigger_error("Bad user name '$name'");
                $this->valid = false;
        }
    }

    public function name()
    {
        if ($this->valid) {
            return $this->name;
        }
    }

    public function validate($userName, $password)
    {
        if ('admin' == strtolower($uerName) && 'secret' == $password) {
            return true;
        }

        return false;
    }
}