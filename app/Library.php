<?php declare(strict_types = 1);

namespace App;

class Library
{
    protected $collection = [];

    public function count()
    {
        return count($this->collection);
    }

    public function add($item)
    {
        $this->collection[] = $item;
    }

    public function getIterator($type = '')
    {
        switch (strtolower($type)) {
            case 'media':
                $iteratorClass = LibraryIterator::class;
                break;
            case 'available':
                $iteratorClass = LibraryAvailableIterator::class;
                break;
            case 'released':
                $iteratorClass = LibraryReleasedIterator::class;
                break;
            default:
                $iteratorClass = LibraryGofIterator::class;
        }

        return new $iteratorClass($this->collection);
    }
}