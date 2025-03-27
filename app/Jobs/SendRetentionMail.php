<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\UserRetention;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRetentionMail implements ShouldQueue
{
    use Queueable;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->user = User::with('planItemUser')->where('id', 1)->oldest()->first();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to([
            'leehongjie91@gmail.com'
        ])->send(new UserRetention($this->user));
    }
}
