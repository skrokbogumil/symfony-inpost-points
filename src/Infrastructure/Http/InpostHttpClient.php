<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\{HttpExceptionInterface, TransportExceptionInterface, DecodingExceptionInterface};
use App\Infrastructure\Http\Exception\InpostClientException;
use App\Domain\Ports\Client\InpostHttpClientInterface;

class InpostHttpClient implements InpostHttpClientInterface
{
    public function __construct(
        private HttpClientInterface $inpostClient,
    ) {
    }


    /**
     * @throws InpostClientException
     */
    public function fetch(string $method, array $params): string
    {
        $query = null;
        if (!empty($params)) {
            $query = \http_build_query($params);
        }
        $path = $query ? \sprintf('%s?%s', $method, $query) : $method;
        try {
            $response = $this->inpostClient->request('GET', $path);
            return $response->getContent();
        } catch (HttpExceptionInterface | TransportExceptionInterface | DecodingExceptionInterface $clientException) {
            throw new InpostClientException($clientException->getMessage(), $clientException->getCode(), $clientException);
        }
    }

}
