<?php

namespace App\Repository\Article;

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
     * @param string|null $fromDate
     * @param string|null $toDate
     * @param string|null $category
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws BadRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string  $keyword,
                           ?string $fromDate = null,
                           ?string $toDate = null,
                           ?string $category = null,
                           int     $page,
                           int     $pageSize
    ) : array
    {
        try {
            $url = config('newsapi.news_api_base_url') . "/everything";
            $queryParams = [
                'apiKey' => config('newsapi.news_api_key'),
                'q' => $keyword,
                'pageSize' => $pageSize,
                'page' => $page,
                'from' => $fromDate ? date('Y-m-d', strtotime($fromDate)) : '',
                'to' => $toDate ? date('Y-m-d', strtotime($toDate)) : '',
            ];

            $response = $this->httpClientService->getRequest($url, $queryParams);
            $body = $response->getBody()->getContents();

            return json_decode($body, true);
        } catch (GuzzleException $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}
