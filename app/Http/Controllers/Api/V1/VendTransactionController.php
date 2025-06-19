<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PlanItem;
use App\Models\VendTransaction;
use App\Models\VendTransactionItem;
use App\Models\User;
use App\Models\UserVoucher;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\VendTransactionResource;
use App\Services\SettingService;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class VendTransactionController extends Controller
{
    use ApiResponse;

    protected $settingService;

    public function __construct()
    {
        $this->settingService = new SettingService();
    }

    /**
     * Display a listing of the resource.
     */
    public function create(Request $request, $userID)
    {
        $user = User::findOrFail($userID);

        DB::beginTransaction();

        $vendTransaction = VendTransaction::create([
            'apk_ver' => $request->apk_ver,
            'datetime' => Carbon::parse($request->datetime)->setTimezone(env('APP_TIMEZONE')),
            'firmware_ver' => $request->firmware_ver,
            'total_amount' => $request->total_amount,
            'customer_id' => $request->customer_id,
            'customer_name' => $request->customer_name,
            'payment_method_id' => $request->payment_method_id,
            'payment_method_name' => $request->payment_method_name,
            'ref_order_id' => $request->ref_order_id,
            'ref_transaction_id' => $request->id,
            'total_promo_amount' => $request->total_promo_amount,
            'total_qty' => $request->total_qty,
            'user_id' => $request->user_id,
            'vend_code' => $request->vend_code,
            'vend_id' => $request->vend_id,
            'vend_prefix_id' => $request->vend_prefix_id,
            'vend_prefix_name' => $request->vend_prefix_name,
        ]);

        foreach ($request->items as $item) {
            VendTransactionItem::create([
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'product_thumbnail_url' => $item['product_thumbnail_url'],
                'qty' => $item['qty'],
                'vend_channel_code' => $item['vend_channel_code'],
                'vend_channel_id' => $item['vend_channel_id'],
                'vend_channel_error_code' => $item['vend_channel_error_code'],
                'vend_channel_error_name' => $item['vend_channel_error_name'],
                'vend_channel_error_id' => $item['vend_channel_error_id'],
                'vend_transaction_id' => $vendTransaction->id,
            ]);
        }

        $vendTransaction->update([
            'total_qty' => $vendTransaction->vendTransactionItems()->count(),
        ]);

        if($vendTransaction->total_promo_amount != 0 && $vendTransaction->total_promo_amount != null) {
            $this->settingService->updateTotalDiscountAmount($vendTransaction->total_promo_amount);
        }

        DB::commit();

        $transactionPlanItem = PlanItem::where('id', $request->plan_item_id)->first();
        if($transactionPlanItem and $transactionPlanItem->is_base) {
            $user->planItemUser->update([
                'used_count' => $user->planItemUser->used_count + 1,
            ]);
        }

        // hardcode for voucher claim
        if($request->vouchers) {
            $voucher = $request->vouchers[0];

            $vendTransaction->update([
                'voucher_code' => $voucher['code'] ?? null,
                'voucher_type' => $voucher['type'] ?? null,
                'voucher_name' => $voucher['name'] ?? null,
                'voucher_value' => $voucher['value'] ?? null,
            ]);

            if($voucher['code'] == 'NEWUSERVOUCHER') {
                $user->is_one_time_voucher_used = true;
                $user->save();
            }

            if($voucher['code'] == 'NEWCONVERTMAGNUM') {
                $user->is_converted_voucher_used = true;
                $user->save();
            }

            $userVoucher = UserVoucher::where('user_id', $user->id)
                ->where('ref_voucher_code', $voucher['code'])
                ->where('status', UserVoucher::STATUS_ACTIVE)
                ->whereDate('date_from', '<=', now())
                ->whereDate('date_to', '>=', now())
                ->first();

            if ($userVoucher) {
                $newUsedCount = $userVoucher->used_count + 1;

                $userVoucher->update([
                    'used_count' => $newUsedCount,
                ]);

                if ($userVoucher->qty == $newUsedCount) {
                    $userVoucher->update([
                        'is_redeemed' => true,
                        'redeemed_at' => now(),
                        'status' => UserVoucher::STATUS_REDEEMED,
                    ]);
                }
            }
        }

        return $this->success('Transaction created successfully');
    }
}
