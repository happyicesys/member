<?php

namespace App\Console\Commands;

use App\Jobs\SendRetentionMail;
use Illuminate\Console\Command;

class SendRetentionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:retention-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Retention Email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendRetentionMail::dispatch();
    }
}
