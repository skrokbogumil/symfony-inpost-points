<?php

namespace App\Tests\UI\Validator;

use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use App\UI\Validator\{SearchPoints, SearchPointsValidator};
use App\UI\Form\Model\SearchPoints as SearchPointsModel;

class SearchPointsTest extends ConstraintValidatorTestCase
{

    protected function createValidator(): ConstraintValidatorInterface
    {
        return new SearchPointsValidator();
    }

    public function dataValid(): \Generator
    {
        yield [$this->createSearchPointsModel('Test', 'Test', '11-111')];
        yield [$this->createSearchPointsModel('Ass', null, null)];
        yield [$this->createSearchPointsModel('Test', null, '22-222')];
    }

    /**
     * @dataProvider dataValid
     */    
    public function testsValid(SearchPointsModel $data): void
    {
        $this->validator->validate($data, new SearchPoints());
        $this->assertNoViolation();
    }

    private function createSearchPointsModel($city, $street, $postCode): SearchPointsModel
    {
        $searchPointsModel = new SearchPointsModel();
        $searchPointsModel->city = $city;
        $searchPointsModel->street =  $street;
        $searchPointsModel->postCode = $postCode;
        return $searchPointsModel;
    }
}
