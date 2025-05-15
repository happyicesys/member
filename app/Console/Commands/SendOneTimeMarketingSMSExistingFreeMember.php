<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\PlanService;
use App\Jobs\SendMarketingSmsExistingFreeMember;

class SendOneTimeMarketingSMSExistingFreeMember extends Command
{
    protected $signature = 'send:one-time-marketing-sms-existing-free-member';

    protected $description = 'Send one-time marketing SMS to existing free members';

    public function handle()
    {
        $planService = new PlanService();
        $freePlan = $planService->getDefaultFreePlan();

        // $users = User::query()
        //     ->with('planItemUser')
        //     ->whereHas('planItemUser', function ($query) use ($freePlan) {
        //         $query->where('plan_id', $freePlan->id);
        //     })
        //     ->where('phone_country_id', 8)
        //     ->oldest()
        //     ->get();

        $users = User::query()
            ->where('phone_number', '96977973')
            ->get();

        if ($users->isEmpty()) {
            $this->info('No free members found.');
            return;
        }

        foreach ($users as $index => $user) {
            dispatch(new SendMarketingSmsExistingFreeMember($user))
                ->delay(now()->addSeconds($index * 1)); // Send 1 every 5 seconds
        }
    }
}
