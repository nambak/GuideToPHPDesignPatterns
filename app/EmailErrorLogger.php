<?php declare(strict_types = 1);

namespace App;

class EmailErrorLogger
{
    protected $addr;
    protected $subject;

    public function __construct($addr, $subject = 'Application Error Message')
    {
        $this->$addr = $addr;
        $this->subject = $subject;
    }

    public function mail($msg): void
    {
        mail($this->addr, $this->subject, date('Y-m-d H:i:s ') . $msg);
    }

    public function update($errorHandler): void
    {
        $error = $errorHandler->getState();
        $this->mail($error['msg']);
    }
}