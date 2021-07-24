<?php declare(strict_types = 1);

namespace App;

use App\WidgetDecorator;

class Invalid extends WidgetDecorator
{
    public function paint(): string
    {
        return "<span class=\"invalid\">{$this->widget->paint()}</span>";
    }
}