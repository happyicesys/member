<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserVoucher;
use App\Services\SysApiService;
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

    // temporary hardcoded at both sides
    const DCVEND_MEMBER_TYPE_ALL = '1';
    const DCVEND_MEMBER_TYPE_FREE = '2';
    const DCVEND_MEMBER_TYPE_CONVERTED = '3';
    const DCVEND_MEMBER_TYPE_GOLD = '4';

    const DCVEND_MEMBER_TYPE_MAPPINGS = [
        self::DCVEND_MEMBER_TYPE_ALL => 'All Members',
        self::DCVEND_MEMBER_TYPE_FREE => 'Free Members',
        self::DCVEND_MEMBER_TYPE_CONVERTED => 'Converted Members',
        self::DCVEND_MEMBER_TYPE_GOLD => 'Gold Members',
    ];


    protected $sysApiService;

    public function __construct()
    {
        $this->sysApiService = new SysApiService();
    }

    public function getVouchers($userID)
    {
        $vouchers = [];

        $user = User::findOrFail($userID);

        $hardcodeVouchers = $this->getHardcodeVoucher($user);
        $userVouchers = $this->getUserSysVouchers($user);
        // dd($userVouchers);
        if($userVouchers) {
            $vouchers = array_merge($hardcodeVouchers, $userVouchers);
        } else {
            $vouchers = $hardcodeVouchers;
        }

        // $vouchers = array_merge(
        //     $this->getHardcodeVoucher($user),
        //     $this->getUserSysVouchers($user)
        // );

        return $vouchers;
    }

    private function getHardcodeVoucher($user)
    {
        $vouchers = [];

        // ========== NEWUSERVOUCHER logic ==========
        $shouldShowNewUserVoucher = true;

        if ($user->phone_number != '69354741' && $user->phone_number != '82269545') {
            if (Carbon::today()->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE))) {
                $shouldShowNewUserVoucher = false;
            }

            if (self::HARDCODE_PROMO_END_DATE && Carbon::today()->gt(Carbon::parse(self::HARDCODE_PROMO_END_DATE))) {
                $shouldShowNewUserVoucher = false;
            }

            if (Carbon::parse($user->created_at)->lt(Carbon::parse(self::HARDCODE_PROMO_START_DATE))) {
                $shouldShowNewUserVoucher = false;
            }
        }

        if ($shouldShowNewUserVoucher) {
            $dateTo = Carbon::parse($user->created_at)->addDays(self::HARDCODE_PROMO_DAYS)->format('Y-m-d');
            $isExpired = Carbon::today()->gt(Carbon::parse($dateTo));

            $status = self::STATUS_ACTIVE;
            if ($isExpired) {
                $status = self::STATUS_EXPIRED;
            }
            if ($user->is_one_time_voucher_used && $user->phone_number != '81300257') {
                $status = self::STATUS_REDEEMED;
            }

            $vouchers[] = [
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
                'matrix' => [],
            ];
        }

        // ========== NEWCONVERTMAGNUM logic ==========
        if ($user->is_converted) {
            $convertedStatus = self::STATUS_ACTIVE;

            if ($user->is_converted_voucher_used) {
                $convertedStatus = self::STATUS_REDEEMED;
            }

            $vouchers[] = [
                'id' => 2,
                'code' => 'NEWCONVERTMAGNUM',
                'type' => self::TYPE_ITEM,
                'channels' => ['19', '20', '21'],
                'date_from' => $user->converted_at->format('Y-m-d'),
                'date_to' => $user->converted_at->copy()->addDays(100)->format('Y-m-d'),
                'name' => 'Free Magnum For Paid Gold Plan',
                'desc' => '',
                'status' => $convertedStatus,
                'min_value' => null,
                'max_promo_value' => null,
                'qty' => 1,
                'value' => null,
                'matrix' => [],
            ];
        }

        return $vouchers;
    }


    public function getSysVouchers($user, $userVouchers)
    {
        return $this->sysApiService->getVouchersDetails(
            // set the userVoucher id as index, ref_voucher_code as value
            $userVouchers->pluck('ref_voucher_code', 'id')->toArray(),
            $user->latest_login_vend_code,
            $user->id
        );
            // ->collect()
            // ->map(function ($voucher) use ($user) {
            //     $status = $voucher['status'] ?? 'active';
            //     $dateFrom = Carbon::parse($voucher['date_from'] ?? $user->created_at)->format('Y-m-d');
            //     $dateTo = Carbon::parse($voucher['date_to'] ?? now())->format('Y-m-d');

            //     return [
            //         'id' => $voucher['id'],
            //         'code' => $voucher['code'],
            //         'type' => $voucher['type'],
            //         'channels' => $voucher['channels'],
            //         'date_from' => $dateFrom,
            //         'date_to' => $dateTo,
            //         'name' => $voucher['name'],
            //         'desc' => $voucher['desc'],
            //         'status' => $status,
            //         'min_value' => $voucher['min_value'] ?? null,
            //         'max_promo_value' => $voucher['max_promo_value'] ?? null,
            //         'qty' => $voucher['qty'] ?? 1,
            //         'value' => $voucher['value'] ?? null,
            //         'matrix' => $voucher['matrix'] ?? [],
            //     ];
            // })->toArray();
    }

    public function getUserSysVouchers($user)
    {
        $vouchers = $this->getSysVouchers($user, $user->userVouchersRedeemable);

        if(!$vouchers) {
            return [];
        }

        $results = [];

        foreach($vouchers as $key => $voucher) {
            $userVoucher = UserVoucher::findOrFail($key);
            if(($userVoucher->ref_voucher_code == $voucher['code']) and ($userVoucher->balanceQty() > 0)) {
                $results[] = [
                    'id' => $voucher['id'],
                    'code' => $voucher['code'],
                    'type' => $voucher['type'],
                    'channels' => array_map('strval', $voucher['channels']),
                    'date_from' => $userVoucher->date_from->format('Y-m-d'),
                    'date_to' => $userVoucher->date_to->format('Y-m-d'),
                    'name' => $voucher['name'],
                    'desc' => $voucher['desc'],
                    'status' => UserVoucher::STATUS_MAPPINGS[$userVoucher->status],
                    'min_value' => $voucher['min_value'] ?? null,
                    'max_promo_value' => $voucher['max_promo_value'] ?? null,
                    'qty' => $userVoucher->balanceQty(),
                    // 'used_count' => $userVoucher->used_count,
                    'value' => $voucher['value'] ?? null,
                    'matrix' => $voucher['matrix'] ?? [],
                ];
            }
        }

        return $results;
    }

}