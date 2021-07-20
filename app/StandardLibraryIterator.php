<?php declare(strict_types = 1);

namespace App;

class StandardLibraryIterator
{
    protected $valid;
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function current()
    {
        return current($this->collection);
    }

    public function next()
    {
        $this->valid = (false !== next($this->collection));
    }

    public function key()
    {
        return key($this->collection);
    }

    public function valid()
    {
        return $this->valid;
    }

    public function rewind()
    {
        $this->valid = (false !== reset($this->collection));
    }
}