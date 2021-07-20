<?php declare(strict_types = 1);

namespace App;

use App\Library;
use \Iterator;

class ForeachableLibrary extends Library implements Iterator
{
    protected $valid;

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