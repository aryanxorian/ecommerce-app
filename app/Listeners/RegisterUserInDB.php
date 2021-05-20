<?php

namespace EcommerceApp\Listeners;

use EcommerceApp\Events\RegisterUser;
use EcommerceApp\Services\User\RegisterInterface;

class RegisterUserInDB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisterUser  $event
     * @return void
     */
    public function handle(RegisterUser $event)
    {
        $registerService = resolve(RegisterInterface::class); 
        $user = $event->getUser();

        $saveHistory = $registerService->register($user);
        return $saveHistory;
    }
}
