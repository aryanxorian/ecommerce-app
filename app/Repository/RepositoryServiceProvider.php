<?php

namespace EcommerceApp\Repository;

use Illuminate\Support\ServiceProvider;

use EcommerceApp\Services\Payment\PaymentService;
use EcommerceApp\Services\Payment\PayPalService;
use EcommerceApp\Services\Payment\StripeService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentService::class,function(){
            if(request()->has('PayPal'))
                return new PayPalService('Rupee');
            
                return new StripeService('Rupee');   
        });
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
