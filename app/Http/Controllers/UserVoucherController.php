<?php

namespace App\Http\Controllers;

use App\Jobs\DispatchDCVendVouchersJob;
use App\Models\User;
use App\Models\VoucherActionRecord;
use Illuminate\Http\Request;

class UserVoucherController extends Controller
{
    public function sync(Request $request)
    {
        // Save sync action log
        VoucherActionRecord::create([
            'action' => $request->action,
            'dcvend_member_type' => $request->dcvend_member_type,
            'dcvend_qty_per_member' => $request->dcvend_qty_per_member ?? 0,
            'is_dcvend' => $request->is_dcvend ?? false,
            'is_recurring' => $request->is_recurring ?? false,
            'valid_duration' => $request->valid_duration ?? 0,
            'valid_unit' => $request->valid_unit ?? 'days',
            'voucher_json' => $request->voucher,
        ]);

        if (!$request->is_dcvend) {
            return response()->json(['message' => 'DCVend not enabled.'], 200);
        }

        $users = collect();

        // Determine target users by member type
        switch ($request->dcvend_member_type) {
            case '1': // all active users
                $users = User::where('is_active', true)->get();
                break;
            case '2': // free plan users
                $users = User::where('is_active', true)
                    ->whereHas('planItemUser', fn($q) => $q->where('plan_id', 1))
                    ->get();
                break;
            case '3': // converted users
                $users = User::where('is_active', true)
                    ->where('is_converted', true)
                    ->get();
                break;
            case '4': // gold plan users
                $users = User::where('is_active', true)
                    ->whereHas('planItemUser', fn($q) => $q->where('plan_id', 2))
                    ->where('is_converted', true)
                    ->get();
                break;
        }

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found for this member type.'], 200);
        }

        // Dispatch the job for voucher processing
        DispatchDCVendVouchersJob::dispatch(
            $users->pluck('id')->toArray(),
            $request->voucher,
            $request->dcvend_qty_per_member,
            $request->valid_duration,
            $request->valid_unit,
            $request->action // 'create' or 'delete'
        );

        return response()->json(['message' => 'Voucher sync job dispatched.'], 200);
    }
}
