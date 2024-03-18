<?php

namespace App\Tests\UI\Form;

use App\UI\Form\DataTransformer\CapitalizeTransformer;
use Symfony\Component\Form\Test\TypeTestCase;
use App\UI\Form\SearchPoints as SearchPointsForm;
use App\UI\Form\Model\SearchPoints as SearchPointsModel;
use Symfony\Component\Form\PreloadedExtension;

class SearchPointsTest extends TypeTestCase
{
    protected function getExtensions(): array
    {
        $type = new SearchPointsForm(new CapitalizeTransformer());

        return [
            new PreloadedExtension([$type], []),
        ];
    }

    public function testSubmitValidData(): void
    {
        $formData = [
            'city' => 'test',
            'street' => 'test2',
            'postCode' => '11-111'
        ];

        $model = new SearchPointsModel();
        $form = $this->factory->create(SearchPointsForm::class, $model);

        $expected = new SearchPointsModel();
        $expected->city = 'Test';
        $expected->street = 'test2';
        $expected->postCode = '11-111';

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($expected, $model);
    }
}
