<?php
declare(strict_types=1);

namespace App\Infrastructure\Deserializer;

use App\Domain\Ports\Deserializer\DeserializerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class InpostDeserializer implements DeserializerInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }
}
