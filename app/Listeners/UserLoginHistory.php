<?php

namespace EcommerceApp\Listeners;

use Carbon\Carbon;
use EcommerceApp\Events\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserLoginHistory
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
     * @param  LoginHistory  $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        
        $current_timestamp = Carbon::now()->toDateTimeString();
        $userinfo = $event->getUser();
        //Log::error($userinfo);
        $saveHistory = DB::table('login_history')->insert(
            ['email' => $userinfo, 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
        );
        return $saveHistory;

    }
}
