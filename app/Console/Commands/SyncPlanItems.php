<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PlanService;
use App\Models\User;

class SyncPlanItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync plan items for all users';

    /**
     * Execute the console command.
     */
    public function handle(PlanService $planService)
    {
        $users = User::all();

        foreach ($users as $user) {
            $planService->syncUserPlan($user);
        }

        $this->info('Plan items synced successfully for all users.');
    }
}
