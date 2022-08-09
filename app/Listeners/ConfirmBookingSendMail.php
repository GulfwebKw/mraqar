<?php

namespace App\Listeners;

use App\Events\ConfirmBookEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ConfirmBookingSendMail
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
     * @param  ConfirmBookEvents  $event
     * @return void
     */
    public function handle(ConfirmBookEvents $event)
    {
        $res= Mail::to(optional($event->booking->booker)->email)->send(new \App\Mail\ConfirmBooking($event->booking));
    }
}
