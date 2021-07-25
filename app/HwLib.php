<?php declare(strict_types = 1);

namespace App;

/**
 * the HwLib helps programmers everywhere write their program
 * 
 * @package Helloworld
 * @version 2
 */
class HwLib
{
    /**
     * target audience
     * 
     * @return string
     */
    public function world(): string
    {
        return 'World!';
    }

    public function greet(): string
    {
        return 'Greetings and Salutations ';
    }

}