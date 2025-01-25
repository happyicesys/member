<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\RegisteredUsers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRegisteredUsersListEmail implements ShouldQueue
{
    use Queueable;

    protected $users;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->users = User::with('phoneCountry')->oldest()->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to([
            // 'sean_lee@foodleague.com.sg',
            // 'daniel.ma@happyice.com.sg',
            // 'kent@happyice.com.sg'
            'leehongjie91@gmail.com'
        ])->send(new RegisteredUsers($this->users));
    }
}
