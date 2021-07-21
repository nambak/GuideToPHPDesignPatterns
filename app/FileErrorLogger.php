<?php declare(strict_types = 1);

namespace App;

class FileErrorLogger
{
    protected $fh;

    public function __construct($fileHandle)
    {
        $this->fh = $fileHandle;
    }

    public function write($msg): void
    {
        fwrite($this->fh, date('Y-m-d H:i:s: ') . $msg);
    }

    public function update($errorHandler): void
    {
        $error = $errorHandler->getState();
        $this->write($error['msg']);
    }
}