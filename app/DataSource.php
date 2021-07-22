<?php declare(strict_types = 1);

namespace App;

class DataSource
{
    protected $source = [];

    public function get($key)
    {
        if (array_key_exists($key, $this->store)) {
            return $this->store[$key];
        }
    }

    public function set($key, $value)
    {
        $this->store[$key] = $value;
    }
}