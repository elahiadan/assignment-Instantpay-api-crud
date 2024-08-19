<?php

namespace App\Observers;

use App\Events\BoardEvent;
use App\Models\Board;
use App\Notifications\BoardNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class BoardObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Board "creating" event.
     */
    public function creating(Board $board): void
    {
        Log::alert("BEFORE CREATING BOARD", [$board]);
    }

    /**
     * Handle the Board "created" event.
     */
    public function created(Board $board): void
    {
        event(new BoardEvent($board));
        $user = Auth::user();
        $user->notify(new BoardNotification($board));
        Log::alert("AFTER CREATED BOARD", [$board]);
    }

    /**
     * Handle the Board "updated" event.
     */
    public function updated(Board $board): void
    {
        //
    }

    /**
     * Handle the Board "deleted" event.
     */
    public function deleted(Board $board): void
    {
        //
    }

    /**
     * Handle the Board "restored" event.
     */
    public function restored(Board $board): void
    {
        //
    }

    /**
     * Handle the Board "force deleted" event.
     */
    public function forceDeleted(Board $board): void
    {
        //
    }
}
