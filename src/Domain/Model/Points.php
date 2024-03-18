<?php
declare(strict_types=1);

namespace App\Domain\Model;

class Points
{
    use Paginator;

    /**
     * @var Point[]
     */
    private array $items = [];


    public function addItem(Point $point): void
    {
        $this->items[] = $point;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @var Point[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}