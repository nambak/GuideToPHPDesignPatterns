<?php declare(strict_types = 1);

namespace App;

class ReleasedLibraryIterator extends StandardLibraryIterator
{
    public function __construct($collection)
    {
        usort($collection, function($a, $b) {
            return ($a->year - $b->year);
        });

        $this->collection = $collection;
    }
}