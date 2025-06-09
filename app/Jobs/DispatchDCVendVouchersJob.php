<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserVoucher;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class DispatchDCVendVouchersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userIDs;
    protected $voucher;
    protected $qty;
    protected $validDuration;
    protected $validUnit;
    protected $action;

    public function __construct($userIDs, $voucher, $qty, $validDuration, $validUnit, $action)
    {
        $this->userIDs = $userIDs;
        $this->voucher = $voucher;
        $this->qty = $qty;
        $this->validDuration = (int) $validDuration;
        $this->validUnit = $validUnit;
        $this->action = $action;
    }

    public function handle(): void
    {
        $dateFrom = now();
        $dateTo = $this->validUnit === 'day'
            ? $dateFrom->copy()->addDays($this->validDuration)
            : $dateFrom->copy()->addMonths($this->validDuration);

        $today = now()->startOfDay();

        User::whereIn('id', $this->userIDs)->chunk(100, function ($users) use ($dateFrom, $dateTo, $today) {
            foreach ($users as $user) {
                if ($this->action === 'create') {
                    $existing = UserVoucher::where('user_id', $user->id)
                        ->where('ref_voucher_code', $this->voucher['code'])
                        ->orderByDesc('date_from')
                        ->first();

                    if (
                        !$existing ||
                        Carbon::parse($existing->date_to)->endOfDay()->lt($today)
                    ) {
                        UserVoucher::create([
                            'user_id' => $user->id,
                            'ref_voucher_id' => $this->voucher['id'],
                            'ref_voucher_code' => $this->voucher['code'],
                            'date_from' => $dateFrom,
                            'date_to' => $dateTo,
                            'is_redeemable' => true,
                            'is_redeemed' => false,
                            'qty' => $this->qty,
                            'status' => UserVoucher::STATUS_ACTIVE,
                        ]);
                    }
                } elseif ($this->action === 'delete') {
                    $user->userVouchers()
                        ->where('ref_voucher_code', $this->voucher['code'])
                        ->delete();
                }
            }
        });
    }
}
