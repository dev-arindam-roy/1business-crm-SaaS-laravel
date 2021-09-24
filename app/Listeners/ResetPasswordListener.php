<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\ResetPasswordEvent;
use App\Mail\ResetPasswordMail;

class ResetPasswordListener implements ShouldQueue
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
    public function handle(ResetPasswordEvent $event)
    {
        $email = $event->user->email_id;
        Mail::to($email)->send(new ResetPasswordMail($event->user));
    }
}
