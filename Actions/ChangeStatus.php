<?php

declare(strict_types=1);

namespace Modules\Ticket\Actions;

use Modules\Ticket\Enums\GeoTicketStatusEnum;
use Modules\Ticket\Models\GeoTicket;

class ChangeStatus
{
    public function execute(GeoTicket $ticket, string $status, string $reason): void
    {
        $ticket->setStatus($status, $reason);
        $ticket->status = GeoTicketStatusEnum::from($status);
        $ticket->save();
    }
}
