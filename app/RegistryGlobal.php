<?php declare(strict_types = 1);

namespace App;

class RegistryGlobal
{
    private $store = [];
    const REGISTRY_GLOBAL_STORE = '__registry_global_store_key__';

    public function __construct()
    {
        if (!array_key_exists(self::REGISTRY_GLOBAL_STORE, $GLOBALS) ||
            !is_array($GLOBALS[self::REGISTRY_GLOBAL_STORE])) {
                $GLOBALS[self::REGISTRY_GLOBAL_STORE] = [];
            }

        $this->store = $GLOBALS[self::REGISTRY_GLOBAL_STORE];
    }

    public function isValid($key): bool
    {
        return array_key_exists($key, $this->store);
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->store)) {
            return $this->store[$key];
        }
    }

    public function set($key, &$obj)
    {
        $this->store[$key] =& $obj;
    }
}