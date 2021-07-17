<?php declare(strict_types = 1);

namespace App;

class VarCache
{
    private $name;
    private $type;

    public function __construct($name, $type = 'string')
    {
        $this->name = "cache/{$name}";
        $this->type = $type;
    }

    public function isValid(): bool
    {
        return file_exists("{$this->name}.php");
    }

    public function set($value): void
    {
        $fileHandle = fopen("{$this->name}.php", 'w');

        switch ($this->type) {
            case 'string':
                $content = sprintf($this->getTemplate(), str_replace("'", "\\'", $value));
                break;
            case 'numeric':
                $content = sprintf($this->getTemplate(), (float) $value);
                break;
            default:
                trigger_error('invalid cache type');
        }

        fwrite($fileHandle, $content);
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
            default:
                trigger_error('invalid cache type');
        }

        return $template;
    }
}