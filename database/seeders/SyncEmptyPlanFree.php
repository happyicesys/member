<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyncEmptyPlanFree extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()
            ->doesntHave('planItemUser')
            ->get();

        if($users->isEmpty()) {
            $this->info('No free members found.');
            return;
        }

        foreach($users as $index => $user) {
            $user->planItemUser()->create([
                'plan_id' => 1,
                'datetime_from' => now(),
                'datetime_to' => now()->addMonth(),
                'is_active' => true,
                'plan_id' => 1,
            ]);
        }
    }
}
