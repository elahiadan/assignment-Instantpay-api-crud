<?php

namespace App\Listeners;

use App\Events\UserEvent;
use App\Jobs\UserJob;
use Illuminate\Support\Facades\Log;

class UserUpdateListener
{
    // Binded with userEvent in EventServiceProvider
    public function handle(UserEvent $userEvent): void
    {
        // Perform additional actions when user is updated
        Log::alert("USER LISTENER", [$userEvent->userEvent]);
        // dispacting the UserJob
        dispatch(new UserJob($userEvent));
    }
}
