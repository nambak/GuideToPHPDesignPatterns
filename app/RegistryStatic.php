<?php declare(strict_types = 1);

namespace App;

class RegistryStatic
{
    public function isValid($key)
    {
        $store =& self::_getRegistry();
        
        return array_key_exists($key, $store);
    }

    public function &get($key)
    {
        $store =& self::_getRegistry();

        if (array_key_exists($key, $store)) {
            return $store($key);
        }
    }

    public function set($key, &$obj)
    {
        $store =& self::_getRegistry();
        $store[$key] =& $obj;
    }
}