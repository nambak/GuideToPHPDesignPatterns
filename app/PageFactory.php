<?php declare(strict_types = 1);

namespace App;

class PAgeFactory
{
    public function getPage()
    {
        $page = (array_key_exists('page', $_REQUEST)) ? strtolower($_REQUEST['page']) : '';

        switch ($page) {
            case 'entry':
                $pageClass = 'Detail';
                break;
            case 'edit':
                $pageClass = 'Edit';
                break;
            case 'comment':
                $pageClass = 'Comment';
                break;
            default:
                $pageClass = 'Index';
        }

        if (!class_exists($pageClass)) {
            require_once "pages/{$pageClass}.php";
        }

        return new $pageClass;
    }
}