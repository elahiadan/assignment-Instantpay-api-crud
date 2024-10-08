<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Bind this event with listeners in EventServiceProvider
    public $userEvent;
    public function __construct($userEvent)
    {
        Log::alert("USER EVENT", [$userEvent]);
        // Receving Array or collection
        $this->userEvent = $userEvent;
    }
}
