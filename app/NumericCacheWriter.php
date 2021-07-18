<?php declare(strict_types = 1);

namespace App;

class NumericCacheWriter
{
    public function store($fileHandle, $numeric)
    {
        $content = sprintf("<?php\n\$cachedContent = %s;", (double) $numeric);
        fwrite($fileHandle, $content);
    }
}