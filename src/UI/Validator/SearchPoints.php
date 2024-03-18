<?php
declare(strict_types=1);

namespace App\UI\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SearchPoints extends Constraint
{
    public $streetAndPostCode = 'When street is set postcode is required';
    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}