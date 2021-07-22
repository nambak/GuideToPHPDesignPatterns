<?php declare(strict_types = 1);

namespace App;

use App\DataSource;

class FieldMatchSpecification
{
    protected $field;
    protected $regex;

    public function __construct($field, $regex)
    {
        $this->field = $field;
        $this->regex = $regex;
    }

    public function isSatisfiedBy(DataSource $dataSource): bool
    {
        return !!preg_match($this->regex, $dataSource->get($this->field));
    }
}