<?php
declare(strict_types=1);

namespace App\Application\Service;

interface InpostAllDataFetcher
{
    public function fetchAll(string $method, array $params): array;
}