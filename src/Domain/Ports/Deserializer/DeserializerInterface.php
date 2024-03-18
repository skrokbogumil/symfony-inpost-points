<?php
declare(strict_types=1);

namespace App\Domain\Ports\Deserializer;

interface DeserializerInterface
{
    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed;
}
