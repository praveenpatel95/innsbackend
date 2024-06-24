<?php

namespace App\Providers;

use App\Repository\Contracts\UserInterface;
use App\Repository\Contracts\UserPreferenceInterface;
use App\Repository\User\UserPreferenceRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserPreferenceInterface::class, UserPreferenceRepository::class);
    }

    public function boot(): void
    {
    }
}
