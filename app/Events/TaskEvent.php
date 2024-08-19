<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TaskEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Bind this event with listeners in EventServiceProvider
    public $taskEvent;
    public function __construct($taskEvent)
    {
        Log::alert("USER EVENT", [$taskEvent]);
        // Receiving Array or collection
        $this->taskEvent = $taskEvent;
    }
}
