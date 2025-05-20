<?php

namespace App\Jobs;

use App\Models\PlanItemUser;
use App\Models\User;
use App\Mail\UserRetention;
use App\Services\PlanService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRetentionMail implements ShouldQueue
{
    use Queueable;

    protected $planService;
    protected $user;
    protected $users;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->planService = new PlanService();
        // $this->user = User::with('planItemUser')->where('id', 1)->oldest()->first();
        $this->users = User::query()
            ->with('planItemUser')
            ->whereHas('planItemUser', function ($query) {
                $query->where('is_required_email_retention', true)
                    ->where('is_email_retention_sent', false)
                    ->where('is_active', true)
                    ->where('plan_id', $this->planService->getDefaultFreePlan()?->id)
                    ->whereDate('datetime_from', '=', Carbon::today());
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
