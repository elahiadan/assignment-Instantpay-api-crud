<?php

namespace App\Jobs;

use App\Mail\TaskMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $taskJob;
    public function __construct($taskJob)
    {
        $this->taskJob = $taskJob;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::alert("TASK JOB", [$this->taskJob]);

        // I amusing queue to perform async task
        // Mail::to('recevie_email@example.com')->queue(new TaskMail($this->taskJob))->delay(now()->addMinutes(1));
        Mail::to('recevie_email@example.com')->queue(new TaskMail($this->taskJob));
    }
}
