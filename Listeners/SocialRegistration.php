<?php

declare(strict_types=1);

namespace Modules\Ticket\Listeners;

use DutchCodingCompany\FilamentSocialite\Events\Registered;

class SocialRegistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->socialiteUser->user;
        $user->email_verified_at = now();
        $user->save();
    }
}
