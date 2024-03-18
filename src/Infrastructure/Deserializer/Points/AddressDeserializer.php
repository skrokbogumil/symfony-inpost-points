<?php
declare(strict_types=1);

namespace App\Infrastructure\Deserializer\Points;

use App\Domain\Model\Point;
use Symfony\Component\Serializer\Normalizer\{DenormalizerInterface, DenormalizerAwareInterface, DenormalizerAwareTrait};

class AddressDeserializer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        $context[self::class] = true;
        if (\array_key_exists('address', $data) && \array_key_exists('address_details', $data)) {
            $data['address'] = \array_merge($data['address'], $data['address_details']);
        }
        return $this->denormalizer->denormalize($data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return empty($context[self::class]) && Point::class === $type;
    }

    public function getSupportedTypes(?string $format): array
    {
        return ['*' => false];
    }
}
