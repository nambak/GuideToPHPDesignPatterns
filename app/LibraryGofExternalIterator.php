<?php declare(strict_types = 1);

namespace App;

class LibraryGofExternalIterator
{
    protected $key = 0;
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function first()
    {
        $this->key = 0;
    }

    public function next()
    {
        return (++$this->key < $this->collection->count());
    }

    public function isDone()
    {
        return ($this->key >= $this->collection->count());
    }

    public function currentItem()
    {
        return $this->collection->get($this->key);
    }
}