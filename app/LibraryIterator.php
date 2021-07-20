<?php declare(strict_types = 1);

namespace App;

class LibraryIterator
{
    protected $collection;
    protected $first = true;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function next()
    {
        if ($this->first) {
            $this->first = false;
            return current($this->collection);
        }
        
        return next($this->collection);
    }
}
