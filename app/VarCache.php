<?php declare(strict_types = 1);

namespace App;

class VarCache
{
    private $name;
    private $type;

    public function __construct($name, $type = 'string')
    {
        $this->name = "cache/{$name}";
        
        switch (strtolower($type)) {
            case 'string':
                $strategy = 'String';
                break;
            case 'numeric':
                $strategy = 'Numeric';
                break;
            case 'serialize':
            default:
                $strategy = 'Serializing';
        }

        $strategy .= 'CacheWriter';
        $this->type = new $strategy;
    }

    public function isValid(): bool
    {
        return file_exists("{$this->name}.php");
    }

    public function set($value): void
    {
        $fileHandle = fopen("{$this->name}.php", 'w');
        $this->type->store($fileHandle, $value);
        fclose($fileHandle);
    }

    public function get()
    {
        if ($this->isValid()) {
            include "{$this->name}.php";
            return $cachedContent;
        }
    }

    private function getTemplate()
    {
        $template = '<?php $cachedContent = ';

        switch ($this->type) {
            case 'string':
                $template .= "'%s';";
                break;
            case 'numeric':
                $template .= "'%s';";
                break;
            case 'serialize':
                $template .= "unserialize(stripslashes('%s'));";
                break;
            default:
                trigger_error('invalid cache type');
        }

        return $template;
    }
}