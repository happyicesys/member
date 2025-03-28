<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class VoucherService
{
    const STATUS_ACTIVE = 'active';
    const STATUS_REDEEMED = 'redeemed';
    const STATUS_EXPIRED = 'expired';
    const STATUS_CANCELLED = 'cancelled';

    const TYPE_ITEM = 'item';
    const TYPE_PERCENT = 'percent';
    const TYPE_AMOUNT = 'amount';

    const HARDCODE_PROMO_START_DATE = '2025-03-19 00:00:00';
    const HARDCODE_PROMO_END_DATE = null;
    const HARDCODE_PROMO_VOUCHER = 'NEWUSERVOUCHER';
    const HARDCODE_PROMO_VOUCHER_ID = 1;
    const HARDCODE_PROMO_DAYS = 60;
    const HARDCODE_PROMO_TYPE = 'item';

    public function getVouchers($userID)
    {
        $user = User::findOrFail($userID);

        $vouchers = $this->getHardcodeVoucher($user);

        return $vouchers;
    }

    private function getHardcodeVoucher($user)
    {
        // if(Carbon::now()->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE)) || $user->created_at->gt(Carbon::now())) {
        if(Carbon::today()->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE))) {
            return [];
        }

        if(self::HARDCODE_PROMO_END_DATE && Carbon::today()->gt(Carbon::parse(self::HARDCODE_PROMO_END_DATE))) {
            return [];
        }

        $dateTo = Carbon::parse($user->created_at)->addDays(self::HARDCODE_PROMO_DAYS)->format('Y-m-d');
        $isExpired = Carbon::today()->gt(Carbon::parse($dateTo)) ? true : false;


        $status = self::STATUS_ACTIVE;

        if($user->is_one_time_voucher_used and $user->phone_number != '81300257') {
            $status = self::STATUS_REDEEMED;
        }

        if($isExpired) {
            $status = self::STATUS_EXPIRED;
        }

        return [
            [
                'id' => self::HARDCODE_PROMO_VOUCHER_ID,
                'code' => self::HARDCODE_PROMO_VOUCHER,
                'type' => self::HARDCODE_PROMO_TYPE,
                'channels' => ['14', '22', '15', '16'],
                'date_from' => Carbon::parse($user->created_at)->format('Y-m-d'),
                'date_to' => $dateTo,
                'name' => 'Free 1 Cornetto for New User',
                'desc' => '',
                'status' => $status,
                'min_value' => null,
                'max_promo_value' => null,
                'qty' => 1,
                'value' => null,
                'matrix' => []
            ],
        ];
    }

}