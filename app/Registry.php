<?php declare(strict_types = 1);

namespace App;

class Registry
{
    static $instance = [];
    private $store = [];

    static public function getInstance()
    {
        if (!self::$instance) {
            self::$instance[0] = new Registry;
        }

        return self::$instance[0];
    }
    
    public function isValid($key): bool
    {
        return array_key_exists($key, $this->store);
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->store)) {
            return $this->store[$key];
        }
    }

    public function set($key, &$obj)
    {
        $this->store[$key] =& $obj;
    }
}