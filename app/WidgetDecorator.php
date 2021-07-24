<?php declare(strict_types = 1);

namespace App;

class WidgetDecorator
{
    public $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    public function paint()
    {
        return $this->widget->paint();
    }
}