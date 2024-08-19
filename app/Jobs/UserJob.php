<?php

namespace App\Jobs;

use App\Mail\UserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // dispatch this job from listeners
    public $userJob;
    public function __construct($userJob)
    {
        $this->userJob = $userJob;
    }

    public function handle(): void
    {
        Log::alert("USER JOB", [$this->userJob]);
        // I amusing queue to perform async task
        // Mail::to('recevie_email@example.com')->queue(new UserMail($this->userJob))->delay(now()->addMinutes(1));
        Mail::to('recevie_email@example.com')->queue(new UserMail($this->userJob));
    }
}
