<?php

namespace EcommerceApp\Services;

use EcommerceApp\Services\Address\AddressInterface;
use EcommerceApp\Services\Address\AddressService;
use EcommerceApp\Services\Cart\CartInterface;
use EcommerceApp\Services\Cart\CartService;
use EcommerceApp\Services\Checkout\CheckoutInterface;
use EcommerceApp\Services\Checkout\CheckoutService;
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
        $this->app->singleton(AddressInterface::class,AddressService::class);
        $this->app->singleton(CheckoutInterface::class, CheckoutService::class);
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