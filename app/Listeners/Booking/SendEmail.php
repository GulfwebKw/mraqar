<?php

namespace App\Listeners\Booking;

use App\Events\Booking;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
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
     * @param Booking $event
     * @return void
     */
    public function handle(Booking $event)
    {
        $data = [
            'booking' => $event->booking,
            'advertising' => $event->advertising
        ];
        $settings=Setting::whereIn('setting_key',['book_email_text_en','book_email_text_ar'])->get()->keyBy('setting_key')->toArray();
        $message=optional($event->advertising->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;
        $messageBooking=optional($event->booking->user)->lang=="ar"?optional($settings['book_email_text_ar'])->setting_value:optional($settings['book_email_text_en'])->setting_value;
//dd($message,$messageBooking);
        ////// send email for owner of advertise
        Mail::to(optional($event->advertising->user)->email)->send(new \App\Mail\Booker($message, $data, 'booking'));
        ///////  send email for booker
        Mail::to(optional($event->booking->booker)->email)->send(new \App\Mail\Booker($messageBooking, $data, 'booker'));

    }
}
