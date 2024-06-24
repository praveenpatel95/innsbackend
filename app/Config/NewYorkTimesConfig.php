<?php

namespace App\Config;

class NewYorkTimesConfig
{
    public static function getBaseUrl(): string
    {
        return config('newsapi.new_york_times_base_url');
    }

    public static function getApiKey(): string
    {
        return config('newsapi.new_york_times_api_key');
    }
}
