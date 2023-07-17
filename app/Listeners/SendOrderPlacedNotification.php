<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\SendEmailJob;
use App\Mail\OrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderPlacedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event)
    {
        $user = $event->user; // Get the user from the event
        $order = $event->order; // Get the order from the event

        dispatch(new SendEmailJob($user, $order));
    }

}
