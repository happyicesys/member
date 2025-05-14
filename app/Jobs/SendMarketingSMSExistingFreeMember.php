<?php

namespace App\Jobs;

use App\Models\User;
use App\Interfaces\SmsInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMarketingSmsExistingFreeMember implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        if (!$this->user->phone) {
            return;
        }
        // Check if the user is already a Gold member
        $smsService = app(\App\Interfaces\SmsInterface::class);

        $message = "DCVend: Your free membership has expired. Upgrade to Gold for RM2.90/mth and get a FREE Magnum ice cream! Redeem at any vending machine today!";
        $smsService->sendSms([$this->user->phoneCountry->phone_code.$this->user->phone_number], $message);
    }
}
