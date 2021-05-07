<?php

namespace EcommerceApp\Providers;

use App\Checkout\PayPal;
use App\Checkout\Stripe;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentInterface::class,function(){
            if(request()->has('PayPal'))
                return new PayPal('Rupee');
            
                return new Stripe('Rupee');   
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
