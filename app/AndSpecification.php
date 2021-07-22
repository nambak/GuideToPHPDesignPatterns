<?php declare(strict_types = 1);

namespace App;

class AndSpecification implements Specification
{
    protected $spec;
    protected $andSpec;

    public function __construct($spec, $andSpec)
    {
        $this->spec = $spec;
        $this->andSpec = $andSpec;
    }

    public function isSatisfiedBy($dataSource)
    {
        return (
            $this->spec->isSatisfiedBy($dataSource) 
            && $this->andSpec->isSatisfiedBy($dataSource)
        );
    }
}