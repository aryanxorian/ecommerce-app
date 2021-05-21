<?php

namespace EcommerceApp\Repository;

use EcommerceApp\Repository\Address\AddressRepository;
use EcommerceApp\Repository\Address\AddressRepositoryInterface;
use EcommerceApp\Repository\Cart\CartRepository;
use EcommerceApp\Repository\Cart\CartRepositoryInterface;
use EcommerceApp\Repository\Product\ProductRepository;
use EcommerceApp\Repository\Product\ProductRepositoryInterface;
use EcommerceApp\Repository\User\UserRepository;
use EcommerceApp\Repository\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(CartRepositoryInterface::class, CartRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(AddressRepositoryInterface::class, AddressRepository::class);
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
