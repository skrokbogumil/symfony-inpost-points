<?php
declare(strict_types=1);

namespace App\Domain\Model;

trait Paginator
{
    private int $count = 0;
    private int $page = 0;
    private int $perPage = 0;
    private int $totalPages = 0;

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}