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
        if (!$this->user->phone_number) {
            return;
        }
        // Check if the user is already a Gold member
        $smsService = app(\App\Interfaces\SmsInterface::class);

        $message = "DCVend: Your plan has expired. Get a free Magnum (worth $4.70) when you upgrade to DCVend Gold Plan at $2.90/month to enjoy 30% discount on ice cream at www.dcvend.com";

        $smsService->sendSms([preg_replace('/[^0-9]/', '', $this->user->phoneCountry->phone_code.$this->user->phone_number)], $message);
    }
}

