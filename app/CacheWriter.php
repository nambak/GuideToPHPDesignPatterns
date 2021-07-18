<?php declare(strict_types = 1);

namespace App;

class CacheWriter
{
    public function store($fileHandle, $var)
    {
        die('abstract class-implement in concrete CacheWriter');
    }
}