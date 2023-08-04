<?php

namespace App\Providers;

use App\Contracts\AddProductInterface;
use App\Contracts\ListProductInterface;
use App\Contracts\ShowProductInterface;
use App\Contracts\UpdateProductInterface;
use App\Services\AddProductService;
use App\Services\ListProductService;
use App\Services\ShowProductService;
use App\Services\UpdateProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AddProductInterface::class, AddProductService::class);
        $this->app->bind(ListProductInterface::class, ListProductService::class);
        $this->app->bind(ShowProductInterface::class, ShowProductService::class);
        $this->app->bind(UpdateProductInterface::class, UpdateProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
