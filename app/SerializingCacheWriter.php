<?php declare(strict_types = 1);

namespace App;

class SerializingCacheWriter
{
    public function store($fileHandle, $var)
    {
        $content = sprintf("<?php\n\$cachedContent = unserialize(stripslashes('%s'));", addslashes(serialize($var)));
        fwrite($fileHandle, $content);
    }
}