<?php

namespace EcommerceApp\Services;

use EcommerceApp\Services\Cart\CartInterface;
use EcommerceApp\Services\Cart\CartService;
use EcommerceApp\Services\Product\ProductInterface;
use EcommerceApp\Services\Product\ProductService;
use EcommerceApp\Services\User\RegisterInterface;
use EcommerceApp\Services\User\RegisterService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductInterface::class, ProductService::class);
        $this->app->singleton(CartInterface::class, CartService::class);
        $this->app->singleton(RegisterInterface::class, RegisterService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}