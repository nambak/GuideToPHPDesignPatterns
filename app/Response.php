<?php declare(strict_types = 1); 

namespace App;

class Response
{
    private $head = '';
    private $body = '';

    public function addHead($content): void
    {
        $this->head .= $content;
    }

    public function addBody($content): void
    {
        $this->body .= $content;
    }

    public function display(): void
    {
        echo $this->fetch();
    }

    private function fetch()
    {
        return '<html>'
            . "<head>{$this->head}</head>"
            . "<body>{$this->body}</body>"
            .'</html>';
    }

    public function redirect($url, $exit = true)
    {
        header("Location:{$url}");
        
        if ($exit) {
            exit;
        }
    }
}