<?php

namespace Modules\Ticket\Listeners;

use Modules\Ticket\Models\Ticket;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ticket\Enums\GeoTicketStatusEnum;
use Modules\Ticket\Events\TicketCreatedEvent;

class TicketCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreatedEvent $event): void
    {
        $status = GeoTicketStatusEnum::PENDING;
        $ticket = $event->ticket;
        $ticket->setStatus($status->value, 'creazione nuovo ticket');
    }
}
