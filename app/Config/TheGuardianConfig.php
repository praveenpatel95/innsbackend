<?php

namespace App\Config;

class TheGuardianConfig
{
    public static function getBaseUrl(): string
    {
        return config('newsapi.theguardian_base_url');
    }

    public static function getApiKey(): string
    {
        return config('newsapi.theguardian_api_key');
    }
}
