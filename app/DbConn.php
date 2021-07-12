<?php declare(strict_types = 1);

namespace App;

class DbConn {
    /**
     * static property to hold singleton instance
     */
    static $instance = false;

    /**
     * constructor
     * 
     * private so only getInstance() method can instantiate
     * 
     * @return void
     */
    private function __construct()
    {
        //
    }

    /**
     * factory method to return the singleton instance
     * 
     * @return DbConn
     */
    static public function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}