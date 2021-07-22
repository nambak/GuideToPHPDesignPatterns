<?php declare(strict_types = 1);

namespace App;

class OrSpecification implements Specification
{
    protected $spec;
    protected $orSpec;

    public function __construct($spec, $orSpec)
    {
        $this->spec = $spec;
        $this->orSpec = $orSpec;
    }

    public function isSatisfiedBy($dataSource)
    {
        return (
            $this->spec->isSatisfiedBy($dataSource)
            || $this->orSpec->isSatisfiedBy($dataSource)
        );
    }
}