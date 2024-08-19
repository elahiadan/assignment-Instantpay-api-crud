<?php

namespace App\Providers;

use App\Events\TaskEvent;
use App\Events\UserEvent;
use App\Events\BoardEvent;
use App\Listeners\TaskListener;
use App\Listeners\UserListener;
use App\Listeners\BoardListener;
use App\Listeners\UserUpdateListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Binding listeners with event
        UserEvent::class => [
            UserListener::class,
            UserUpdateListener::class,
        ],
        BoardEvent::class => [
            BoardListener::class
        ],
        TaskEvent::class => [
            TaskListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Event::listen(
        //     UserEvent::class,
        //     UserListener::class,
        // );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
