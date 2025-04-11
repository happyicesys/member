<?php

namespace App\Console\Commands;

use App\Jobs\SendRegisteredUsersListEmailJob;
use Illuminate\Console\Command;

class SendRegisteredUsersListEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:registered-users-list-email';

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
        SendRegisteredUsersListEmailJob::dispatch();
    }
}
