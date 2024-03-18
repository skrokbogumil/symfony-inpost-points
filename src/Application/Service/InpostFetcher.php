<?php
declare(strict_types=1);

namespace App\Application\Service;

class InpostFetcher
{
    const POINTS_METHOD = 'points';

    /**
     * @var InpostDataFetcher[]
     */
    private $handlers;

    public function __construct(
        iterable $handlers,
    ) {
        $this->handlers = iterator_to_array($handlers);
    }


    public function get(string $method, array $params)
    {
        foreach($this->handlers as $handler) {
            if($handler->support($method)) {  
                return $handler->fetch($method, $params);
            }
        }
    }
}
