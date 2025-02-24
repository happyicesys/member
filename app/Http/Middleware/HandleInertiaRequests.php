<?php

namespace App\Http\Middleware;

use App\Models\PlanItemUser;
use App\Http\Resources\PlanItemUserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),
            'auth' => [
                'operatorCountry' => $user ? $user->phoneCountry : null,
                'user' => $user ? $user->only(['id', 'name', 'email', 'is_admin', 'login_count', 'phone_country_id', 'phone_number', 'plan_id']) : null,
                'plan' => $user && $user->plan ? $user->plan->only(['id', 'name', 'price', 'description']) : null,
                'planItemUser' => $user && $user->planItemUser ? PlanItemUserResource::make($user->planItemUser) : null,
                'isPlanExpiringNotification'=> $user && $user->planItemUser ? $this->calculateIsPlanExpiring($user->planItemUser) : null,
            ],
        ];
    }

    private function calculateIsPlanExpiring($item)
    {
        if(abs(Carbon::parse($item->datetime_to)->diffInDays(Carbon::today())) <= PlanItemUser::NOTIFICATION_BEFORE_DAYS) {
            return true;
        }

        return false;
    }
}
