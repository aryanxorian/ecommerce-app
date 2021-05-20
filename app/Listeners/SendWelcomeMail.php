<?php

namespace EcommerceApp\Listeners;

use EcommerceApp\Events\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
class SendWelcomeMail
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
     * @param  WelcomeMail  $event
     * @return void
     */
    public function handle(WelcomeMail $event)
    {
        Log::error("hello");
        $userData = $event->getData();
        $data = ['name'=> $userData['name'], 'data' => 'Account created Successfully'];
        $user['to'] = $userData['email'];
        $user['name'] = $userData['name'];
        Mail::send('welcome.mail', $data, function ($message) use ($user) {
             $message->from('ecommerce.app21.com', 'Ecommerce App');
            // $message->sender('john@johndoe.com', 'John Doe');
            $message->to($user['to'], $user['name']);
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            // $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Welcome to Ecommerce App');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });
    }
}
