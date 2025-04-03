<?php

namespace App\Console\Commands;

use App\Mail\UserRetention;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSingleRetentionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:single-retention-email';

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
        $user = User::where('phone_number', '81300257')->first();

        Mail::to($user->email)->send(new UserRetention($user));
    }
}
