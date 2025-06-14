<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\PlanService;
use Illuminate\Console\Command;
use App\Jobs\SendMarketingExistingFreeMember;

class SendOneTimeMarketingExistingFreeMember extends Command
{
    protected $signature = 'send:one-time-marketing-existing-free-member';

    protected $description = 'Send one-time marketing email to existing free members';

    protected PlanService $planService;

    public function __construct()
    {
        parent::__construct();
        $this->planService = new PlanService();
    }

    public function handle()
    {
        $freePlan = $this->planService->getDefaultFreePlan();

        $users = User::query()
            ->with('planItemUser')
            ->whereHas('planItemUser', function ($query) use ($freePlan) {
                $query->where('plan_id', $freePlan->id);
            })
            ->oldest()
            ->get();

        // $users = User::query()
        // ->where('email', 'leehongjie91@gmail.com')
        // ->get();

        if ($users->isEmpty()) {
            $this->info('No free members found.');
            return;
        }

        foreach ($users as $index => $user) {
            dispatch(new SendMarketingExistingFreeMember($user))
                ->delay(now()->addSeconds($index * 3)); // send 1 every 10 seconds
        }
    }
}
