<?php

namespace Modules\Ticket\Listeners;

use Modules\Ticket\Models\Ticket;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ticket\Enums\GeoTicketStatusEnum;

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
    public function handle(Ticket $event): void
    {
        $status = GeoTicketStatusEnum::PENDING;
        // dddx([GeoTicketStatusEnum::PENDING, $status->value, $status->getLabel()]);
        $ticket = $event->ticket;
        $ticket->setStatus($status->value, 'creazione nuovo ticket');
        // dddx($ticket->status);
    }
}
