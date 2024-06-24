<?php

namespace App\Repository\Article;

use App\Config\NewsAPIConfig;
use App\Exceptions\BadRequestException;
use App\Repository\Contracts\ArticleInterface;
use App\Services\HttpClientService;

class NewsAPIRepository implements ArticleInterface
{
    /**
     * @param HttpClientService $httpClientService
     */
    public function __construct(
        protected HttpClientService $httpClientService
    )
    {}

    /**
     * @param string $keyword
     * @param string|null $date
     * @param string|null $category
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws BadRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string  $keyword,
                           ?string $date = null,
                           ?string $category = null,
                           int     $page,
                           int     $pageSize
    ) : array
    {
        try {
            $url = NewsAPIConfig::getBaseUrl() . "/everything";
            $queryParams = [
                'apiKey' => NewsAPIConfig::getApiKey(),
                'q' => $keyword,
                'pageSize' => $pageSize,
                'page' => $page,
                'from' => $date ? date('Y-m-d', strtotime($date)) : '',
                'to' => $date ? date('Y-m-d', strtotime($date)) : '',
            ];

            $response = $this->httpClientService->getRequest($url, $queryParams);
            $body = $response->getBody()->getContents();

            return json_decode($body, true);
        } catch (GuzzleException $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}
