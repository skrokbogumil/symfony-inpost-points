<?php
declare(strict_types=1);

namespace App\Domain\Model;

class Address
{
    private ?string $line1 = null;
    private ?string $line2 = null;
    private ?string $city = null;
    private ?string $province = null;
    private ?string $postCode = null;
    private ?string $street = null;
    private ?string $buildingNumber = null;
    private ?string $flatNumber = null;

    public function setLine1(?string $line1): void
    {
        $this->line1 = $line1;
    }

    public function getLine1(): ?string
    {
        return $this->line1;
    }

    public function setLine2(?string $line2): void
    {
        $this->line2 = $line2;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setPostCode(?string $postCode): void
    {
        $this->postCode = $postCode;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setBuildingNumber(?string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function setFlatNumber(?string $flatNumber): void
    {
        $this->flatNumber = $flatNumber;
    }

    public function getFlatNumber(): ?string
    {
        return $this->flatNumber;
    }
}