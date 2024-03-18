<?php
declare(strict_types=1);

namespace App\Domain\Model;

class Point
{
    private string $name;
    private Address $address;

    public function __construct()
    {
        $this->address = new Address;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }
}