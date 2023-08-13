<?php

namespace App\Providers;

use App\Service\Impl\UserServiceImpl;
use App\Service\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // cara 1 : register singleton
    public array $singletons = [
        UserService::class => UserServiceImpl::class
    ];

    public function provides(): array
    {
        return [UserService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        // cara 2 : register singleton
        // $this->app->singleton(UserService::class, function ($app) {
        //     return new UserServiceImpl();
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
