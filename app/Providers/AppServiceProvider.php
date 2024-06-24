<?php

namespace App\Providers;

use App\Exceptions\BadRequestException;
use App\Repository\Article\NewsAPIRepository;
use App\Repository\Article\NYTRepository;
use App\Repository\Article\TheGuardianRepository;
use App\Repository\Contracts\ArticleInterface;
use App\Services\HttpClientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleInterface::class, function ($app) {
            $source = request()->input('source');
            if (!$source) {
                throw new BadRequestException('Source is required');
            }
            $httpClientService = $app->make(HttpClientService::class);
            switch ($source) {
                case 'newsapi':
                    return new NewsAPIRepository($httpClientService);
                case 'theguardian':
                    return new TheGuardianRepository($httpClientService);
                case 'nyt':
                    return new NYTRepository($httpClientService);
                default:
                    throw new BadRequestException('Invalid source');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
