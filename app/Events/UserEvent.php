<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Bind this event with listeners in EventServiceProvider
    public $userEvent;
    public function __construct($userEvent)
    {
        // Receving Array or collection
        $this->userEvent = $userEvent;
    }
}
