<?php declare(strict_types = 1);

namespace App;

use App\FieldEqualSpecification;
use App\FieldGreaterOrEqualSpecification;
use App\OrSpecification;
use App\AndSpecification;

class PolicyFactory
{
    public function createJasonPolicy()
    {
        return $this->equal('name', 'Jason')
            ->and_($this->greaterThanOrEqual('age', 30)
            ->and_($this->equal('sex', 'male')
            ->and_($this->equal('mail', 'jsweat_php@tyahoo.com')
            ->or_($this->equal('mail', 'jsweat@users.sourceforge.net')
        ))));
    }

    protected function equal($field, $value)
    {
        return new FieldEqualSpecification($field, $value);
    }

    protected function greaterThanOrEqual($field, $value)
    {
        return new FieldGreaterThanOrEqualSpecification($field, $value);
    }
}