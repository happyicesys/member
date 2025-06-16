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
use Illuminate\Support\Facades\Http;

class SyncSysVouchersToLocal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $singleUser;
    protected $isForNewUser;

    public function __construct(?User $singleUser = null, bool $isForNewUser = false)
    {
        $this->singleUser = $singleUser;
        $this->isForNewUser = $isForNewUser;
    }

    public function handle(): void
    {
        $response = Http::get(env('SYS_API_BASE_URL') . '/api/vouchers/dcvend');
        // dd($response->status(), $response->body());

        if (!$response->ok()) return;

        $vouchers = $response->json('data');
        $users = $this->singleUser
            ? collect([$this->singleUser])
            : User::where('is_active', true)->get();

        foreach ($vouchers as $voucher) {
            if (!($voucher['is_dcvend'] ?? false)) continue;

            // In cron mode, skip non-recurring
            if (!$this->isForNewUser && !($voucher['is_recurring'] ?? false)) {
                continue;
            }

            $eligibleUsers = $this->filterUsersByMemberType($users, $voucher['dcvend_member_type'] ?? null);

            foreach ($eligibleUsers as $user) {
                $dateFrom = $this->isForNewUser ? $user->created_at->copy() : now();
                $dateTo = ($voucher['valid_unit'] ?? 'day') === 'day'
                    ? $dateFrom->copy()->addDays((int) $voucher['valid_duration'])
                    : $dateFrom->copy()->addMonths((int) $voucher['valid_duration']);

                $todayDate = now()->toDateString();

                $existing = UserVoucher::where('user_id', $user->id)
                    ->where('ref_voucher_code', $voucher['code'])
                    ->orderByDesc('date_from')
                    ->first();

                if ($existing) {
                    $existingDateTo = Carbon::parse($existing->date_to)->toDateString();

                    if ($existingDateTo < $todayDate && $existing->status !== UserVoucher::STATUS_EXPIRED) {
                        $existing->update(['status' => UserVoucher::STATUS_EXPIRED]);
                    }

                    if ($existingDateTo >= $todayDate) {
                        continue; // still valid, skip new
                    }
                }

                // Create new voucher
                UserVoucher::create([
                    'user_id' => $user->id,
                    'ref_voucher_id' => $voucher['id'],
                    'ref_voucher_code' => $voucher['code'],
                    'date_from' => $dateFrom,
                    'date_to' => $dateTo,
                    'is_redeemable' => true,
                    'is_redeemed' => false,
                    'qty' => $voucher['dcvend_qty_per_member'] ?? 1,
                    'status' => UserVoucher::STATUS_ACTIVE,
                ]);
            }
        }
    }

    private function filterUsersByMemberType($users, $type)
    {
        return $users->filter(function ($user) use ($type) {
            if ($type === '1') return true;
            if ($type === '2') return $user->planItemUser?->plan_id === 1;
            if ($type === '3') return $user->is_converted;
            if ($type === '4') return $user->planItemUser?->plan_id === 2;
            return false;
        });
    }
}
