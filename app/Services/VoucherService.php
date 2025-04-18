<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class VoucherService
{
    const STATUS_ACTIVE = 'active';
    const STATUS_REDEEMED = 'redeemed';
    const STATUS_EXPIRED = 'expired';

    const TYPE_ITEM = 'item';
    const TYPE_PERCENT = 'percent';
    const TYPE_AMOUNT = 'amount';

    const HARDCODE_PROMO_START_DATE = '2025-04-09 00:00:00';
    const HARDCODE_PROMO_END_DATE = null;
    const HARDCODE_PROMO_VOUCHER = 'NEWUSERVOUCHER';
    const HARDCODE_PROMO_VOUCHER_ID = 1;
    const HARDCODE_PROMO_DAYS = 7;
    const HARDCODE_PROMO_TYPE = 'item';

    public function getVouchers($userID)
    {
        $user = User::findOrFail($userID);

        $vouchers = $this->getHardcodeVoucher($user);

        return $vouchers;
    }

    private function getHardcodeVoucher($user)
    {

        if($user->phone_number != '169354741') {
            if(Carbon::today()->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE))) {
                return [];
            }

            if(self::HARDCODE_PROMO_END_DATE && Carbon::today()->gt(Carbon::parse(self::HARDCODE_PROMO_END_DATE))) {
                return [];
            }

            if(Carbon::parse($user->created_at)->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE))) {
                return [];
            }
        }

        $dateTo = Carbon::parse($user->created_at)->addDays(self::HARDCODE_PROMO_DAYS)->format('Y-m-d');
        $isExpired = Carbon::today()->gt(Carbon::parse($dateTo)) ? true : false;


        $status = self::STATUS_ACTIVE;

        if($isExpired) {
            $status = self::STATUS_EXPIRED;
        }

        if($user->is_one_time_voucher_used and $user->phone_number != '81300257') {
            $status = self::STATUS_REDEEMED;
        }

        return [
            [
                'id' => self::HARDCODE_PROMO_VOUCHER_ID,
                'code' => self::HARDCODE_PROMO_VOUCHER,
                'type' => self::HARDCODE_PROMO_TYPE,
                'channels' => ['14', '22', '15', '16'],
                'date_from' => Carbon::parse($user->created_at)->format('Y-m-d'),
                'date_to' => $dateTo,
                'name' => 'Free 1 Cornetto for New Sign-up',
                'desc' => '',
                'status' => $status,
                'min_value' => null,
                'max_promo_value' => null,
                'qty' => 1,
                'value' => null,
                'matrix' => []
            ],
            // [
            //     'id' => 2,
            //     'code' => 'PERCENTVOUCHER',
            //     'type' => self::TYPE_PERCENT,
            //     'channels' => ['14', '22', '15', '16'],
            //     'date_from' => Carbon::parse($user->created_at)->format('Y-m-d'),
            //     'date_to' => $dateTo,
            //     'name' => '15 Percent Off',
            //     'desc' => '',
            //     'status' => self::STATUS_ACTIVE,
            //     'min_value' => 100,
            //     'max_promo_value' => 500,
            //     'qty' => 1,
            //     'value' => 15,
            //     'matrix' => []
            // ],
            // [
            //     'id' => 3,
            //     'code' => 'AMOUNTVOUCHER',
            //     'type' => self::TYPE_AMOUNT,
            //     'channels' => ['14', '22', '15', '16'],
            //     'date_from' => Carbon::parse($user->created_at)->format('Y-m-d'),
            //     'date_to' => $dateTo,
            //     'name' => '1 Dollar Off for 5 Dollar Spend',
            //     'desc' => '',
            //     'status' => self::STATUS_ACTIVE,
            //     'min_value' => 500,
            //     'max_promo_value' => null,
            //     'qty' => 1,
            //     'value' => 100,
            //     'matrix' => []
            // ],
        ];
    }

}