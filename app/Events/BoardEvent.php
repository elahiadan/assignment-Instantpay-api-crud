<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BoardEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Bind this event with listeners in EventServiceProvider
    public $boardEvent;
    public function __construct($boardEvent)
    {
        Log::alert("BOARD EVENT", [$boardEvent]);
        // Receiving Array or collection
        $this->boardEvent = $boardEvent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('channel-name'),
        ];
    }
}
