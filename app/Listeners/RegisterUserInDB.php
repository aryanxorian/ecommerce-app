<?php

namespace EcommerceApp\Listeners;

use EcommerceApp\Events\RegisterUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        $user = $event->getUser();
        // Log::error($user);
        $saveHistory = DB::table('users')->insert(
            ['name' => $user['name'], 'email' => $user['email'], 'password' => Hash::make($user['password'])]
        );
        return $saveHistory;
    }
}
