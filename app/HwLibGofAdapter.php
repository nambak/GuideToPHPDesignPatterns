<?php declare(strict_types = 1);

namespace App;


class HwLibGofAdapter extends HwLib     // extending version 2.0
{
    public function hello()
    {
        return parent::greet();
    }
}