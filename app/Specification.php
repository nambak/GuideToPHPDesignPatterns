<?php declare(strict_types = 1);

namespace App;

use App\DataSource;

interface Specification
{
    public function isSatisfiedBy(DataSource $dataSource): bool;
}