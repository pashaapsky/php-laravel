<?php

namespace App\Providers;

use App\Services\PushNotificationsService;
use Illuminate\Support\ServiceProvider;

class PushNotificationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->app->singleton(PushNotificationsService::class, function() {
            return new PushNotificationsService(env('PUSH_ALL_API_ID'), env('PUSH_ALL_API_KEY'));
        });
    }
}
