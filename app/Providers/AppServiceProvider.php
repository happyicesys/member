<?php

namespace App\Providers;

use App\Interfaces\SmsInterface;
use App\Services\IsmsService;
use App\Services\OneWaySmsService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Dynamically bind the correct SMS service based on config
        $this->app->bind(SmsInterface::class, function () {
            return match (config('sms.sms_service')) {
                'oneway' => app(OneWaySmsService::class),
                'isms' => app(IsmsService::class),
                default => app(IsmsService::class),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::calculateTaxes();
        Vite::prefetch(concurrency: 3);
        // Passport::routes();
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::tokensExpireIn(now()->addMinutes(30));
        Passport::refreshTokensExpireIn(now()->addDays(1));
        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
