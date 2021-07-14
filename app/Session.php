<?php declare(strict_types = 1);

namespace App;

class Session
{
    public function __construct()
    {
        self::init();
    }

    static public function init()
    {
        if (!isset($_SESSION)) {
            if (headers_sent()) {
                trigger_error('Session not started before creating session object');
            } else {
                session_start();
            }
        }
    }

    public function isValid($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function get($key)
    {
        return (array_key_exists($key, $_SESSION)) ? $_SESSION[$key] : null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function clear($key)
    {
        unset($_SESSION[$key]);
    }
}