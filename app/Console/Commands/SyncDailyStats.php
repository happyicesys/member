<?php

namespace App\Console\Commands;

use App\Jobs\SyncStats;
use App\Models\Stat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncDailyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:daily-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Previous Daily Stats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday();

        SyncStats::dispatch($yesterday, $yesterday, Stat::TYPE_DAILY);
    }
}
