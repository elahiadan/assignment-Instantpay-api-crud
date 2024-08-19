<?php

namespace App\Jobs;

use App\Mail\BoardMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BoardJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $boardJob;
    public function __construct($boardJob)
    {
        $this->boardJob = $boardJob;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::alert("BOARD JOB", [$this->boardJob]);

        // I amusing queue to perform async task
        // Mail::to('recevie_email@example.com')->queue(new BoardMail($this->boardJob))->delay(now()->addMinutes(1));
        Mail::to('recevie_email@example.com')->queue(new BoardMail($this->boardJob));
    }
}
