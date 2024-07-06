<?php

namespace App\Providers;

use App\Http\Controllers\ProductController;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Implementations\Eloquent\ProductRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->bind(ProductController::class, function ($app) {
            return new ProductController($app->make(ProductRepository::class));
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
