<?php

namespace App\Providers;

use App\Events\Booking;
use App\Events\ConfirmBookEvents;
use App\Events\NewAdvertising;
use App\Events\Payment;
use App\Events\UserRegistered;
use App\Listeners\ConfirmBookingSendMail;
use App\Listeners\Payment\SendMail;
use App\Listeners\SendEmail;
use App\Listeners\TestL;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        NewAdvertising::class=>[
            SendEmail::class
        ],
        UserRegistered::class=>[
            \App\Listeners\UserRegistered::class,
          //  TestL::class
        ],
        Booking::class=>[
            \App\Listeners\Booking\SendEmail::class,
        ],
        Payment::class=>[
            SendMail::class
        ],
        ConfirmBookEvents::class=>[
            ConfirmBookingSendMail::class
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

        //
    }
}
