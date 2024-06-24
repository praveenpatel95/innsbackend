<?php

namespace App\Repository\Article;

use App\Config\TheGuardianConfig;
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

    public function search(string  $keyword,
                           ?string $date = null,
                           ?string $category = null,
                           int     $page,
                           int     $pageSize
    ) : array    {
        try {
            $requestUrl = TheGuardianConfig::getBaseUrl() . "/search";
            $queryParams = [
                'api-key' => TheGuardianConfig::getApiKey(),
                'q' => $keyword,
                'page' => $page,
            ];

            if ($date) {
                $queryParams['begin_date'] = date('Ymd', strtotime($date));
                $queryParams['end_date'] = date('Ymd', strtotime($date));
            }

            $response = $this->httpClientService->getRequest($requestUrl, $queryParams);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (GuzzleException $exception) {
            throw new BadRequestException($exception->getMessage());
        }
    }
}
