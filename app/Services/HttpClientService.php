<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class HttpClientService
{

    /**
     * @param Client $client
     */
    public function __construct(
        protected Client $client
    )
    {}

    /**
     * @param string $url
     * @param array $queryParams
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRequest(string $url, array $queryParams): ResponseInterface
    {
        $request = new Request('GET', $url);

        return $this->client->send($request, [
            'query' => $queryParams
        ]);
    }
}
