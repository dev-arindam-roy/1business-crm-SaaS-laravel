<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AccountEmailVerificationEvent;
use App\Mail\AccountEmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class AccountEmailVerificationListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(AccountEmailVerificationEvent $event)
    {
        $email = $event->user->email_id;
        Mail::to($email)->send(new AccountEmailVerificationMail($event->user));
    }
}
