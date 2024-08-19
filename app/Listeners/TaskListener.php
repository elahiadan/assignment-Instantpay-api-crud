<?php

namespace App\Listeners;

use App\Jobs\TaskJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskListener
{
    public function handle(object $event): void
    {
        // Receive an Task event
        // Perform additional actions when the event is triggered
        // For example, logging the event details to the application log
        Log::alert("TASK LISTENER", [$event->taskEvent]);
       
        // Dispatch the TaskJob to handle the task asynchronously
        dispatch(new TaskJob($event->taskEvent));
    }
}
