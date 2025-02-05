<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\Stat;
use App\Models\User;
use App\Models\VendTransaction;
use Carbon\Carbon;

class StatService
{
    public function generateStat($dateFrom, $dateTo, $type)
    {
        $dateFrom = Carbon::parse($dateFrom)->startOfDay();
        $dateTo = Carbon::parse($dateTo)->endOfDay();

        $cumulativeLandingPageVisitCount = $this->getSettingTotalLandingPageVisitCount();
        $landingPageVisitCount = $this->getLandingPageVisitCount($dateFrom, $dateTo, $type);
        $newUserCount = $this->getNewUserCount($dateFrom, $dateTo);
        $newUserSourceJson = $this->getNewUserSourceJson($dateFrom, $dateTo);
        $promoAmount = $this->getPromoAmount($dateFrom, $dateTo);
        $salesAmount = $this->getSalesAmount($dateFrom, $dateTo);

        Stat::create([
            'cumulative_landing_page_visit_count' => $cumulativeLandingPageVisitCount,
            'landing_page_visit_count' => $landingPageVisitCount,
            'new_user_count' => $newUserCount,
            'new_user_source_json' => $newUserSourceJson,
            'promo_amount' => $promoAmount,
            'sales_amount' => $salesAmount,
            'type' => $type,
        ]);
    }

    private function getLandingPageVisitCount($dateFrom, $dateTo, $type)
    {
        // use total_landing_page_visit_count from setting to deduct last stat
        $setting = Setting::first();
        $lastStat = Stat::where('type', $type)->orderBy('created_at', 'desc')->first();
        $currentVisitCount = 0;

        if ($lastStat) {
            $currentVisitCount = $setting->total_landing_page_visit_count - $lastStat->cumulative_landing_page_visit_count;
        } else {
            $currentVisitCount = $setting->total_landing_page_visit_count;
        }

        return $currentVisitCount;
    }

    private function getNewUserCount($dateFrom, $dateTo)
    {
        return User::whereBetween('created_at', [$dateFrom, $dateTo])->count();
    }

    private function getNewUserSourceJson($dateFrom, $dateTo)
    {
        $newUsers = User::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        $sourceJson = [];

        // group by newUsers ref_id, and its count, if null or '', set as undefined
        foreach ($newUsers as $newUser) {
            $refId = $newUser->ref_id ?? 'vm';
            if (array_key_exists($refId, $sourceJson)) {
                $sourceJson[$refId] += 1;
            } else {
                $sourceJson[$refId] = 1;
            }
        }

        return $sourceJson;
    }

    private function getPromoAmount($dateFrom, $dateTo)
    {
        return VendTransaction::whereBetween('created_at', [$dateFrom, $dateTo])->sum('total_promo_amount');
    }

    private function getSalesAmount($dateFrom, $dateTo)
    {
        return VendTransaction::whereBetween('created_at', [$dateFrom, $dateTo])->sum('total_amount');
    }

    private function getSettingTotalLandingPageVisitCount()
    {
        return Setting::first()->total_landing_page_visit_count;
    }
}