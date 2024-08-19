<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Support\Facades\Log;

class UserListener
{
    // Binded with userEvent in EventServiceProvider
    public function handle(UserEvent $userEvent): void
    {
        // Do something when the event is triggered
        Log::alert("USER LISTENER", [$userEvent->userEvent]);
    }
}
