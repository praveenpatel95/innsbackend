<?php

namespace App\Mappers;

class NewsApiMapper
{
    /**
     * @param array $data
     * @return array
     */
    public function transformNewsApiData(array $data): array
    {
        return array_map(function ($article) {
            return [
                'author_name' => $article['author'] ?? '',
                'title' => $article['title'] ?? '',
                'publish_date' => $article['publishedAt'] ?? '',
                'description' => $article['description'] ?? '',
                'url' => $article['url'] ?? '',
                'source' => $article['source']['name'] ?? '',
                'image_url' => $article['urlToImage'] ?? ''
            ];
        }, $data['articles'] ?? []);
    }

    /**
     * @param array $data
     * @return array
     */
    public function transformNytData(array $data): array
    {
        return array_map(function ($article) {
            return [
                'author_name' => $article['byline']['original'] ?? '',
                'title' => $article['headline']['main'] ?? '',
                'publish_date' => $article['pub_date'] ?? '',
                'description' => $article['abstract'] ?? '',
                'url' => $article['web_url'] ?? '',
                'source' => $article['source'] ?? '',
                'image_url' => !empty($article['multimedia']) ? $article['multimedia'][0]['url'] : ''
            ];
        }, $data['response']['docs'] ?? []);
    }

    /**
     * @param array $data
     * @return array
     */
    public function transformGuardianData(array $data): array
    {
        return array_map(function ($result) {
            return [
                'author_name' => '',
                'title' => $result['webTitle'] ?? '',
                'publish_date' => $result['webPublicationDate'] ?? '',
                'description' => '',
                'url' => $result['webUrl'] ?? '',
                'source' => $result['pillarName'] ?? '',
                'image_url' => '',
            ];
        }, $data['response']['results'] ?? []);
    }
}
