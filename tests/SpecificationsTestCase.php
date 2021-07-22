<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\DataSource;
use App\FieldEqualSpecification;
use App\FieldMatchSpecification;
use App\FieldGreaterThanOrEqualSpecification;

final class SpecificationsTestCase extends TestCase
{
    protected $dataSource;

    protected function setUp(): void
    {
        $this->dataSource = new DataSource;
        $this->dataSource->set('name', 'Jason');
        $this->dataSource->set('age', 34);
        $this->dataSource->set('email', 'jason@example.com');
        $this->dataSource->set('sex', 'male');
    }

    public function testFieldEqualSpecification()
    {
        $nameJason = new FieldEqualSpecification('name', 'Jason');

        $this->assertTrue($nameJason->isSatisfiedBy($this->dataSource));

        $sexOther = new FieldEqualSpecification('sex', 'other');

        $this->assertFalse($sexOther->isSatisfiedBy($this->dataSource));
    }

    public function testFieldMatchSpecification()
    {
        $validEmail = new FieldMatchSpecification('email', '/^[^\s@]+@[^\s.]+(?:\.[^\s.]+)+/');

        $this->assertTrue($validEmail->isSatisfiedBy($this->dataSource));

        $nameTenLetters = new FieldMatchSpecification('name', '/^%\w{10}$/');

        $this->assertFalse($nameTenLetters->isSatisfiedBy($this->dataSource));
    }

    public function testFieldGreaterThanOrEqualSpecification()
    {
        $adult = new FieldGreaterThanOrEqualSpecification('age', 18);
        $presidentialAge = new FieldGreaterThanOrEqualSpecification('age', 35);

        $this->assertTrue($adult->isSatisfiedBy($this->dataSource));
        $this->assertFalse($presidentialAge->isSatisfiedBy($this->dataSource));
    }
}