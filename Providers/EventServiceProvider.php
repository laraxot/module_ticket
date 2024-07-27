<?php

declare(strict_types=1);

namespace Modules\Ticket\Providers;

use DutchCodingCompany\FilamentSocialite\Events\Registered as SocialRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Ticket\Events\TicketCreatedEvent;
use Modules\Ticket\Listeners\SocialRegistration;
use Modules\Ticket\Listeners\TicketCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // SocialRegistered::class => [
        //     SocialRegistration::class
        // ]
        TicketCreatedEvent::class => [
            TicketCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
