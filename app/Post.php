<?php declare(strict_types = 1);

namespace App;

class Post
{
    public $store = [];

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

    public function autoFill()
    {
        $ret = new self;

        foreach ($_POST as $key => $value) {
            $ret->set($key, $value);
        }

        return $ret;
    }
}