<?php

namespace App\Repository\Article;

use App\Exceptions\BadRequestException;
use App\Repository\Contracts\ArticleInterface;
use App\Services\HttpClientService;

class TheGuardianRepository implements ArticleInterface
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
            $requestUrl = config('newsapi.theguardian_base_url') . "/search";
            $queryParams = [
                'api-key' => config('newsapi.theguardian_api_key'),
                'q' => $keyword,
                'page' => $page,
            ];

            if ($fromDate && $toDate) {
                $queryParams['begin_date'] = date('Ymd', strtotime($fromDate));
                $queryParams['end_date'] = date('Ymd', strtotime($toDate));
            }

            $response = $this->httpClientService->getRequest($requestUrl, $queryParams);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (GuzzleException $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}
