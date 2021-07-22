<?php declare(strict_types = 1);

namespace App;

use App\Specification;

abstract class BaseSpecification implements Specification
{
    protected $field;

    public function and_($spec) { return new AndSpecification($this, $spec); }
    public function or_($spec) { return new OrSpecification($this, $spec); }
}