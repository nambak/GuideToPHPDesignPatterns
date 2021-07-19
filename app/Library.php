<?php declare(strict_types = 1);

namespace App;

class Library
{
    public function getIterator($type = false)
    {
        switch (strtolower($type)) {
            case 'media':
                $iteratorClass = 'LibraryIterator';
                break;
            default:
                $iteratorClass = 'LibraryGofIterator';
        }

        return new $iteratorClass($this->collaction);
    }
}