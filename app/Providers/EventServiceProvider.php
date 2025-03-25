<?php

namespace App\Providers;

use App\Models\Tour;
use App\Observers\TourObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        // Пример: 'App\Events\UserRegistered' => ['App\Listeners\SendWelcomeEmail'],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Tour::observe(TourObserver::class);
    }
}
