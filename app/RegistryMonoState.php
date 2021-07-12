<?php declare(strict_types = 1);

namespace App;

class RegistryMonoState
{
    protected static $store = [];

    public function isValid($key): bool
    {
        return array_key_exists($key, self::$store);
    }

    public function get($key)
    {
        if (array_key_exists($key, self::$store)) {
            return self::$store[$key];
        }
    }

    public function set($key, $obj)
    {
        self::$store[$key] = $obj;
    }
}