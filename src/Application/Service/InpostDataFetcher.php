<?php
declare(strict_types=1);

namespace App\Application\Service;

interface InpostDataFetcher
{
    public function support(string $method): bool;
    public function fetch(string $method, array $params): object;
}