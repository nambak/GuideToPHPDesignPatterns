<?php declare(strict_types = 1);

namespace App;

use App\WidgetDecorator;

class Labeled extends WidgetDecorator
{
    public $lable;

    public function __construct($label, $widget)
    {
        $this->lable = $label;
        parent::__construct($widget);
    }

    public function paint()
    {
        return "<b>{$this->label}:</b> {$this->widget->paint()}";
    }
}