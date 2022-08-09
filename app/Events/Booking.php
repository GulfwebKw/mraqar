<?php

namespace App\Events;

use App\Models\Advertising;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Booking
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Advertising
     */
    public $advertising;
    /**
     * @var Booking
     */
    public $booking;

    /**
     * Create a new event instance.
     *
     * @param Advertising $advertising
     * @param \App\Models\Booking $booking
     */
    public function __construct(Advertising $advertising,\App\Models\Booking $booking)
    {
        //
        $this->advertising = $advertising;
        $this->booking = $booking;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
