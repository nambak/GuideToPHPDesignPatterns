<?php declare(strict_types = 1); 

namespace App;

class AddressBook
{
    public $registry;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
    }

    public function findByID($id)
    {
        if (!$this->registry->isValid($id)) {
            $this->registry->set($id, new Contact($id));
        }

        return $this->registry->get($id);
    }
}