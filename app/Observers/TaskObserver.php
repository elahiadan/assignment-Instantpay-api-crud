<?php

namespace App\Observers;

use App\Events\TaskEvent;
use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    public function creating(Task $task): void
    {
        Log::alert("BEFORE CREATING TASK", [$task]);
    }
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        event(new TaskEvent($task));
        Auth::user()->notify(new TaskNotification($task));
        Log::alert("AFTER CREATING TASK", [$task]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
