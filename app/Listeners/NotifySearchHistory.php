<?php


namespace App\Listeners;
use App\Events\NewAdvertising;
use App\Jobs\NotifyUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class NotifySearchHistory implements ShouldQueue
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'notifyUser';
    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 60;
    /**
     * Reward a gift card to the customer.
     *
     * @param  \App\Events\NewAdvertising  $event
     * @return void
     */
    public function handle(NewAdvertising $event)
    {
            dispatch(new NotifyUser($event->advertising))->onQueue('notifyUser')->afterResponse();
    }
    /**
     * Determine whether the listener should be queued.
     *
     * @param  \App\Events\NewAdvertising  $event
     * @return bool
     */
    public function shouldQueue(NewAdvertising $event)
    {
        return true;
        //return $event->order->subtotal >= 5000;
    }

}