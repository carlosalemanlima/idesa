<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\AuthorAppService;
use App\Services\Impl\DefaultAuthorAppService;
use App\Services\BookAppService;
use App\Services\Impl\DefaultBookAppService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthorAppService::class, DefaultAuthorAppService::class);
        $this->app->bind(BookAppService::class, DefaultBookAppService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping(); // Remove wrapping for Resources
    }
}
