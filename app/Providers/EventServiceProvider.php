<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AccountEmailVerificationEvent;
use App\Listeners\AccountEmailVerificationListener;
use App\Events\ResetPasswordEvent;
use App\Listeners\ResetPasswordListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AccountEmailVerificationEvent::class => [
            AccountEmailVerificationListener::class,
        ],
        ResetPasswordEvent::class => [
            ResetPasswordListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
