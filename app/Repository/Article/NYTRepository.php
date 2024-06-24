<?php

namespace App\Repository\Article;

use App\Exceptions\BadRequestException;
use App\Repository\Contracts\ArticleInterface;
use App\Services\HttpClientService;

class NYTRepository implements ArticleInterface
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
    ) : array    {
        try {
            $requestUrl = config('newsapi.new_york_times_base_url') . "/articlesearch.json";
            $customParams = [];

            if ($fromDate && $toDate) {
                $customParams = [
                    'begin_date' => date('Ymd', strtotime($fromDate)),
                    'end_date' => date('Ymd', strtotime($toDate)),
                ];
            }

            $queryParams = [
                    'api-key' => config('newsapi.new_york_times_api_key'),
                    'q' => $keyword,
                    'page' => $page,
                ] + $customParams;

            $response = $this->httpClientService->getRequest($requestUrl, $queryParams);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (GuzzleException $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}
