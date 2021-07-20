<?php declare(strict_types = 1);

namespace App;

class LibraryAvailableIterator
{
    protected $collection = [];
    protected $first = true;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function next()
    {
        if ($this->first) {
            $this->frist = false;
            $ret = current($this->collection);
        } else {
            $ret = next($this->collection);
        }

        if ($ret && 'library' !== $ret->status) {
            return $this->next();
        }

        return $ret;
    }
}