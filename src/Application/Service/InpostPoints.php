<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Ports\Deserializer\DeserializerInterface;
use App\Domain\Ports\Client\InpostHttpClientInterface;
use App\Domain\Model\{Points, Point};

class InpostPoints implements InpostDataFetcher, InpostAllDataFetcher
{
    const POINTS_METHOD = 'points';
    const PER_PAGE_MAX = 500;

    public function __construct(private InpostHttpClientInterface $inpostClient, private DeserializerInterface $deserializer)
    {
    }

    /**
     * @return Points
     */
    public function fetch(string $method, array $params): object
    {
        $data = $this->inpostClient->fetch($method, $params);
        /** @var Points $deserializedData */
        $deserializedData = $this->deserializer->deserialize($data, Points::class, 'json');

        return $deserializedData;
    }

    /**
     * @return Point[]
     */
    public function fetchAll(string $method, array $params): array
    {
        $data = [];
        $totalPages = $page = 1;

        while($page <= $totalPages) {
            $points = $this->fetch($method, \array_merge($params, ['page' => $page]));
            $data = \array_merge($data, $points->getItems());

            $page = $points->getPage()+1;
            $totalPages = $points->getTotalPages();
        }
        return $data;
    }

    public function support(string $method): bool
    {
        return self::POINTS_METHOD === $method;
    }
}
