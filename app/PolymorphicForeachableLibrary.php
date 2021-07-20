<?php declare(strict_types = 1);

namespace App;

use App\Library;
use \Iterator;
use App\ReleasedLibraryIterator;
use App\StandardLibraryIterator;

class PolymorphicForeachableLibrary extends Library implements Iterator
{
    protected $iterator;
    protected $iteratorType;

    public function __constuct()
    {
        $this->setIteratorType();
    }

    public function setIteratorType($type = '')
    {
        switch (strtolower($type)) {
            case 'released':
                $this->iteratorType = ReleasedLibraryIterator::class;
                break;
            default:
                $this->iteratorType = StandardLibraryIterator::class;
        }

        $this->rewind();
    }

    public function current()
    {
        return $this->iterator->current();
    }

    public function next()
    {
        return $this->iterator->next();
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }

    public function rewind()
    {
        $type = $this->setIteratorType();
        $this->iterator = new $type($this->collection);
        $this->iterator->rewind();
    }
}