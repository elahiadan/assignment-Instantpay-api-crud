<?php

namespace App\Listeners;

use App\Events\BoardEvent;
use App\Jobs\BoardJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BoardListener
{
    public function handle(BoardEvent $event): void
    {
        // Receive an Board event
        // Perform additional actions when the event is triggered
        // For example, logging the event details to the application log
        Log::info("BOARD LISTENER", [$event->boardEvent]);

        // Dispatch a BoardJob to handle the board asynchronously
        dispatch(new BoardJob($event->boardEvent));
    }
}
