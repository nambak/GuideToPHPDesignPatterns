<?php declare(strict_types = 1);

namespace App;

use App\LibraryIterator;

class LibraryReleasedIterator extends LibraryIterator
{
    protected $collection;
    protected $sortedKeys;
    protected $key = -1;

    public function __construct($collection)
    {
        $this->collection = $collection;
        
        $sortFunct = function ($a, $b, $c = false) {
            static $collection;

            if ($c) {
                $collection = $c;
                return;
            }

            return ($collection->get($a)->year - $collection->get($b)->year);
        };

        $sortFunct(null, null, $this->collection);
        $this->sortedKeys = $this->collection->keys();
        usort($this->sortedKeys, $sortedFunct);
    }

    public function next()
    {
        if (++$this->key >= $this->collection->count()) {
            return false;
        } else {
            return $this->collection->get($this->sortedKesy[$this->key]);
        }
    }
}