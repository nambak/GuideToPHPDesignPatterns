<?php declare(strict_types = 1);

namespace App;

use App\Assessor;

class TestableAssessor extends Assessor
{
    public function getPropInfo($name)
    {
        return Assessor::getPropInfo($name);
    }
}