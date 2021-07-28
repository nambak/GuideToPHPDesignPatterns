<?php declare(strict_types = 1);

namespace App;

require_once 'adodb/adodb.inc.php';

class DB
{
    public $conn;

    // static class, we do not need a constructor
    public function __constructor($id = false, $conn = false) 
    {
        $this->conn = $conn ?: self::conn();
    }

    public static function conn()
    {
        if (!$conn) {
            $conn = adoNewConnection('mysql');
            $conn->connect('localhost', 'root', 'root', 'test');
            $conn->setFetchMode(ADOBD_FETCH_ASSOC);
        }

        return $conn;
    }
}