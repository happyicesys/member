<?php

namespace App\Console\Commands;

use App\Models\Referral;
use App\Services\UserService;
use Illuminate\Console\Command;

class GenerateNewReferralCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:referral-codes {count?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new referral codes with empty user';

    protected $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count') ?? 1;

        for ($i = 0; $i < $count; $i++) {
            Referral::create([
                'code' => $this->userService->generateReferralCode(),
                'user_id' => null,
            ]);
        }
    }
}
