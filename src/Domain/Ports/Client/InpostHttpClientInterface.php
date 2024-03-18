<?php
declare(strict_types=1);

namespace App\Domain\Ports\Client;

interface InpostHttpClientInterface
{
    public function fetch(string $method, array $params): string;
}
