<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessWelcomeMail implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new WelcomeMail($this->user));
        } catch (\Throwable $e) {
            // Log the exception with context so we can diagnose queue failures
            Log::error('ProcessWelcomeMail failed: ' . $e->getMessage(), [
                'user_id' => $this->user->id ?? null,
                'user_email' => $this->user->email ?? null,
                'exception' => $e->getTraceAsString(),
            ]);

            // Re-throw so the job is marked as failed and can be inspected
            throw $e;
        }
    }
}
