<?php

namespace App\Console\Commands;

use App\Jobs\SyncSysVouchersToLocal;
use Illuminate\Console\Command;

class SyncRenewableVouchersDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:renewable-vouchers-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SyncSysVouchersToLocal::dispatch();
    }
}
