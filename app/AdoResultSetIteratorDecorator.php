<?php declare(strict_types = 1);

namespace App;

class AdoResultSetIteratorDecorator implements Iterator
{
    protected $rs;

    public function __construct($rs)
    {
        $this->rs = new ADODB_Iterator($rs);
    }

    public function current()
    {
        return $this->rs->fetchObj();
    }

    public function next()
    {
        return $this->rs->next();
    }

    public function key()
    {
        return $this->rs->key();
    }

    public function valid()
    {
        return $this->rs->valid();
    }

    public function rewind()
    {
        return $this->rs->rewind();
    }
}