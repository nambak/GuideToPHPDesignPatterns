<?php declare(strict_types = 1);

namespace App;

class StringCacheWriter
{
    public function store($fileHandler, $string)
    {
        $content = sprintf("<?php\n\$cachedContent = '%s';" . str_replace("'", "\\'", $string));
        fwrite($fileHandler, $content);
    }
}