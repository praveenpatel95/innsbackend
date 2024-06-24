<?php

namespace App\Config;

class NewsAPIConfig
{
    public static function getBaseUrl(): string
    {
        return config('newsapi.news_api_base_url');
    }

    public static function getApiKey(): string
    {
        return config('newsapi.news_api_key');
    }
}
