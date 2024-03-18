<?php
declare(strict_types=1);

namespace App\UI\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use App\UI\Form\Model\SearchPoints as SearchPointsModel;
use App\UI\Validator\SearchPoints;

#[\Attribute]
class SearchPointsValidator extends ConstraintValidator
{
    /**
     * @param SearchPointsModel $searchPoints
     * @param SearchPoints $constraint
     */
    public function validate($searchPoints, Constraint $constraint): void
    {
        if (!$searchPoints instanceof SearchPointsModel) {
            throw new UnexpectedValueException($searchPoints, SearchPointsModel::class);
        }

        if (!$constraint instanceof SearchPoints) {
            throw new UnexpectedValueException($constraint, SearchPoints::class);
        }
        
        if ($searchPoints->street && !$searchPoints->postCode) {
            $this->context
                ->buildViolation($constraint->streetAndPostCode)
                ->atPath('postCode')
                ->addViolation();
        }
    }
}