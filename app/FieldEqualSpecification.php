<?php declare(strict_types = 1);

namespace App;

use App\DataSource;
use App\BaseSpecification;

class FieldEqualSpecification extends BaseSpecification
{
    protected $field;
    protected $value;

    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function isSatisfiedBy(DataSource $dataSource): bool
    {
        return ($dataSource->get($this->field) == $this->value);
    }
}