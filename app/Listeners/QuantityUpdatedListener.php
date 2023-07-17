<?php

namespace App\Listeners;

use App\Events\QuantityUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class QuantityUpdatedListener implements ShouldQueue
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
    public function handle(QuantityUpdated $event)
    {
        // Access event properties
        $productId = $event->productId;
        $updatedQuantity = $event->updatedQuantity;

        // Handle the event (e.g., logging, triggering additional actions)
        // For example, log the updated quantity
        Log::info("Quantity updated for product with ID $productId -> Available items: $updatedQuantity");
    }
}
