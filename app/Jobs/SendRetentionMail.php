<?php

namespace App\Jobs;

use App\Models\PlanItemUser;
use App\Models\User;
use App\Mail\UserRetention;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRetentionMail implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $users;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->user = User::with('planItemUser')->where('id', 1)->oldest()->first();
        $this->users = User::query()
            ->with('planItemUser')
            ->whereHas('planItemUser', function ($query) {
                $query->where('is_required_email_retention', true)
                    ->where('is_email_retention_sent', false)
                    ->where('is_active', true)
                    ->whereDate('datetime_to', '<=', Carbon::today()->addDays(PlanItemUser::NOTIFICATION_EMAIL_DAYS));
            })
            ->oldest()
            ->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->users->isEmpty()) {
            return;
        }

        foreach($this->users as $user) {
            Mail::to($user->email)->queue(new UserRetention($user));
            $user->planItemUser->update([
                'is_email_retention_sent' => true
            ]);
        }
    }
}
