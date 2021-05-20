<?php

namespace EcommerceApp\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use EcommerceApp\Events\LoginHistory;
use EcommerceApp\Listeners\UserLoginHistory;
use EcommerceApp\Events\RegisterUser;
use EcommerceApp\Listeners\RegisterUserInDB;
use EcommerceApp\Events\AddProduct;
use EcommerceApp\Listeners\AddProductInDB;
use EcommerceApp\Events\WelcomeMail;
use EcommerceApp\Listeners\SendWelcomeMail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // LoginHistory::class => [
        //     UserLoginHistory::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            RegisterUser::class,
            [RegisterUserInDB::class,'handle']);
        Event::listen(
            LoginHistory::class,
            [UserLoginHistory::class, 'handle']
        );
        Event::listen(
            WelcomeMail::class,
            [SendWelcomeMail::class,]
        );

    }

    // public function shouldDiscoverEvents()
    // {
    //     return true;
    // }
}
