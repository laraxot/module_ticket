<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Modules\Ticket\Enums\GeoTicketStatusEnum;
use Modules\Ticket\Enums\GeoTicketTypeEnum;
use Modules\Ticket\Enums\TicketPriorityEnum;

class GeoTicket extends Ticket
{
    protected $table = 'tickets';

    public function casts(): array
    {
        $data = parent::casts();
        $my = [
            'status' => GeoTicketStatusEnum::class,
            'priority' => TicketPriorityEnum::class,
            'type' => GeoTicketTypeEnum::class,
        ];

        return array_merge($data, $my);
    }
}
