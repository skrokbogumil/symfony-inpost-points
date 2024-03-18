<?php
declare(strict_types=1);

namespace App\UI\Form\Model;

class SearchPoints 
{
    public ?string $street = null;
    public string $city = '';
    public ?string $postCode = null;
    public ?string $name = null;
}