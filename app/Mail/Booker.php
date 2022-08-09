<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Booker extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $type;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $message
     * @param $data
     * @param $type
     */
    public function __construct($message,$data,$type)
    {
        $this->message=$message;
        $this->type=$type;
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message=$this->message;
        $data=$this->data;
        if($this->type=="booking"){
            return $this->markdown('emails.booking',compact('message','data'))->subject('New Booking Request');
        }
        return $this->markdown('emails.booker',compact('message','data'))->subject('New Booking');
    }
}
