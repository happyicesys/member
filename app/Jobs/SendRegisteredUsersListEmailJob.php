<?php

namespace App\Jobs;

use App\Models\Stat;
use App\Models\User;
use App\Mail\RegisteredUsers;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;
use App\Services\PlanService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class SendRegisteredUsersListEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;

    protected string $remotePath;
    protected $smsService;
    protected $planService;

    public function __construct()
    {
        $this->planService = new PlanService();
    }

    public function handle(): void
    {

        // Step 1: Run raw SQL for fast data
        $rawUsers = collect(DB::select("
        WITH vt AS (
            SELECT user_id, COUNT(*) AS total_transactions, SUM(total_qty) AS total_qty
            FROM vend_transactions
            GROUP BY user_id
        ),
        vt30 AS (
            SELECT user_id, COUNT(*) AS total_transactions_l30d, SUM(total_qty) AS total_qty_l30d
            FROM vend_transactions
            WHERE created_at >= NOW() - INTERVAL 30 DAY
            GROUP BY user_id
        ),
        vtl AS (
            SELECT user_id, MAX(created_at) AS latest_purchase_date
            FROM vend_transactions
            GROUP BY user_id
        ),
        vtf_first AS (
            SELECT user_id, MIN(created_at) AS first_created
            FROM vend_transactions
            GROUP BY user_id
        ),
        vtf AS (
            SELECT vt1.user_id, vt1.vend_code, vt1.created_at AS first_purchase_date
            FROM vend_transactions vt1
            JOIN vtf_first vt2 ON vt1.user_id = vt2.user_id AND vt1.created_at = vt2.first_created
        )
        SELECT
            users.id,
            users.name,
            users.email,
            users.converted_at,
            users.dob,
            users.phone_number,
            users.ref_id,
            users.is_converted,
            users.is_one_time_voucher_used,
            users.created_at AS created_at,
            countries.phone_code AS country_code,
            plans.name AS plan_name,
            plan_item_users.datetime_to AS plan_expiry,
            plan_items.max_count AS plan_max_count,
            plan_item_users.used_count AS used_count,
            COALESCE(vt.total_transactions, 0) AS transaction_count,
            COALESCE(vt.total_qty, 0) AS total_qty,
            COALESCE(vt30.total_transactions_l30d, 0) AS transaction_count_l30d,
            COALESCE(vt30.total_qty_l30d, 0) AS total_qty_l30d,
            vtl.latest_purchase_date,
            vtf.first_purchase_date,
            vtf.vend_code AS first_vend_code
        FROM users
        LEFT JOIN countries ON countries.id = users.phone_country_id
        LEFT JOIN plan_item_users ON users.id = plan_item_users.user_id AND plan_item_users.is_active = 1
        LEFT JOIN plans ON plans.id = plan_item_users.plan_id
        LEFT JOIN plan_items ON plans.id = plan_items.plan_id
        LEFT JOIN vt ON users.id = vt.user_id
        LEFT JOIN vt30 ON users.id = vt30.user_id
        LEFT JOIN vtl ON users.id = vtl.user_id
        LEFT JOIN vtf ON users.id = vtf.user_id
        ORDER BY users.created_at ASC
    "));

        $twoDaysAgoStat = Stat::where('type', Stat::TYPE_DAILY)->whereDate('created_at', Carbon::yesterday()->subDay())->first();
        $yesterdayStat = Stat::where('type', Stat::TYPE_DAILY)->whereDate('created_at', '<', Carbon::today())->latest()->first();
        $todayStat = Stat::where('type', Stat::TYPE_DAILY)->whereDate('created_at', Carbon::today())->first();

        // 2. Stat totals
        $totals = [
            'yesterday' => User::whereDate('created_at', now()->subDay())->count(),
            'last_2_days' => User::whereDate('created_at', now()->subDays(2))->count(),
            'last_3_days' => User::whereDate('created_at', now()->subDays(3))->count(),
            'total_active_users' => User::query()->count(),
            'new_paid_gold_users' => User::where('is_converted', true)
                ->whereDate('converted_at', Carbon::yesterday())
                ->count(),
            'total_paid_gold_users' => User::where('is_converted', true)->whereHas('planItemUser', function($query) {
                $query->where('plan_id', $this->planService->getGoldPlan()->id);
            })->count(),
            'free_cornetto_claimed' => User::where('is_one_time_voucher_used', true)->count(),
            'landing_page_visit_yesterday' => $todayStat ? $todayStat->landing_page_visit_count : 0,
            'landing_page_visit_2_days_ago' => $yesterdayStat ? $yesterdayStat->landing_page_visit_count : 0,
            'landing_page_visit_3_days_ago' => $twoDaysAgoStat ? $twoDaysAgoStat->landing_page_visit_count : 0,
            'accumulated_landing_page_visit' => $todayStat ? $todayStat->cumulative_landing_page_visit_count : 0,
            'sign_up_rate_yesterday' => $todayStat ? round(($todayStat->new_user_count / $todayStat->landing_page_visit_count) * 100, 2) : 0,
            'sign_up_rate_2_days_ago' => $yesterdayStat ? round(($yesterdayStat->new_user_count / $yesterdayStat->landing_page_visit_count) * 100, 2) : 0,
            'sign_up_rate_3_days_ago' => $twoDaysAgoStat ? round(($twoDaysAgoStat->new_user_count / $twoDaysAgoStat->landing_page_visit_count) * 100, 2) : 0,
        ];

        // 3. SMS stats
        $this->smsService = $this->getSmsService();
        $creditBalance = $this->smsService->getCreditBalance();
        $avgCreditPerUser = 0;


        if ($yesterdayStat && $todayStat) {
            $usedSmsCreditBalance = $todayStat->latest_sms_credit_balance - $yesterdayStat->latest_sms_credit_balance;
            $avgCreditPerUser = $todayStat->new_user_count > 0
                ? $usedSmsCreditBalance / $todayStat->new_user_count
                : 0;
        }

        // 4. Map export data
        $exportData = $rawUsers->map(function ($user) {
            return [
                'Member ID' => $user->id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Date of Birth' => $user->dob ? Carbon::parse($user->dob)->format('Y-m-d') : '',
                'Country Code' => $user->country_code ?? 'N/A',
                'Phone Number' => $user->phone_number,
                'Created At' => Carbon::parse($user->created_at)->format('Y-m-d H:i:s'),
                'First Purchase Machine' => $user->first_vend_code ?? '',
                'Reference ID' => $user->ref_id,
                'Plan Name' => $user->plan_name ?? 'Free',
                'Plan Expiry' => $user->plan_expiry ? Carbon::parse($user->plan_expiry)->format('Y-m-d') : '',
                'Plan Max Count' => $user->plan_max_count,
                'Used Count' => $user->used_count,
                'Transaction Count' => $user->transaction_count,
                'Total Quantity' => $user->total_qty,
                '30D Transaction Count' => $user->transaction_count_l30d,
                '30D Total Quantity' => $user->total_qty_l30d,
                'Latest Purchase Date' => $user->latest_purchase_date,
                'Is Converted' => $user->is_converted ? 'Yes' : 'No',
                'Converted At' => $user->is_converted ? Carbon::parse($user->converted_at)->format('Y-m-d H:i:s') : '',
                'Is Claim Free Cornetto' => $user->is_one_time_voucher_used ? 'Yes' : 'No',
            ];
        });

        // 5. Export to local temp path
        $tempPath = storage_path('app/temp_registered_users.xlsx');
        (new FastExcel($exportData))->export($tempPath);

        // 6. Upload to DigitalOcean Spaces
        $this->remotePath = 'exports/excels/registered/' . now()->format('Ymd_His') . '.xlsx';
        Storage::disk('digitaloceanspaces')->put($this->remotePath, fopen($tempPath, 'r+'), 'public');

        // 7. Delete temp file
        unlink($tempPath);

        // 8. Email with data
        $data = [
            'totals' => $totals,
            'sms_credit_balance' => $creditBalance,
            'avg_credit_per_user' => round(abs($avgCreditPerUser), 2),
        ];

        Mail::to([
            'sean_lee@foodleague.com.sg',
            'daniel.ma@happyice.com.sg',
            'kent@happyice.com.sg',
            'brianlee@happyice.com.my',
            // 'leehongjie91@gmail.com',
        ])->send(new RegisteredUsers($this->remotePath, $data));
    }

    private function getSmsService()
    {
        $smsService = config('sms.sms_service');  // .env setting

        return match ($smsService) {
            'oneway' => new OneWaySmsService(),
            default => new IsmsService(),
        };
    }
}
