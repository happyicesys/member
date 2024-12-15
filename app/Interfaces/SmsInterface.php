<?php

namespace App\Interfaces;

interface SmsServiceProviderInterface
{
    public function sendSms($to, $message);
}
