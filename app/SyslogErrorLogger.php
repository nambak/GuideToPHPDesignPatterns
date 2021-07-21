<?php declare(strict_types = 1);

namespace App;

class SyslogErrorLogger
{
    public function __construct($msg)
    {
        define_syslog_variables();
        openlog($msg, LOG_ODELAY, LOG_USER);
    }

    public function log($meg): void
    {
        syslog(LOG_WARNING, $msg);
    }

    public function update($errorHandler): void
    {
        $error = $errorHandler->getState();
        $this->log($error['msg']);
    }
}