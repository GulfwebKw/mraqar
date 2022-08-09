<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmBooking extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Booking
     */
    public $booking;
    public $title;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param Booking $booking
     */
    public function __construct(Booking $booking)
    {
        //
        $this->booking = $booking;
        if (app()->getLocale()=='ar'){
            $this->title='تأكيد الحجز';
            if ($booking->status==1){
                $this->message='تم قبول طلب الحجز الخاص بك';
        }
            else{
                $this->message='تم رفض طلب الحجز الخاص بك';

            }
        }
        else{
            $this->title='Confirm Booking';
            if ($booking->status==1){
                $this->message='Your Booking request accepted';
        }
            else{
                $this->message='Your Booking request rejected';

            }
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm-booking')->subject('Confirm Booking Booking');
    }
}
