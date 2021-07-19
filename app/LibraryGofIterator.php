<?php declare(strict_types = 1);

namespace App;

class LibraryGofIterator
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function currentItem()
    {
        return current($this->collection);
    }

    public function next()
    {
        return (false !== next($this->collection));
    }

    public function isDone()
    {
        return (false !== current($this->collection));
    }

    public function first()
    {
        reset($this->collection);
    }
}