<?php

declare(strict_types=1);

namespace Modules\Ticket\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Ticket\Models\Activity;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketHour;
use Webmozart\Assert\Assert;

class TicketHoursExport implements FromCollection, WithHeadings
{
    public function __construct(public Ticket $ticket)
    {
    }

    public function headings(): array
    {
        return [
            '#',
            'Ticket',
            'User',
            'Time',
            'Hours',
            'Activity',
            'Date',
            'Comment',
        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        // return $this->ticket->hours
        //     ->map(static fn (TicketHour $item): array => [
        //         '#' => $item->ticket?->code,
        //         'ticket' => $item->ticket?->name,
        //         'user' => $item->user?->name,
        //         'time' => $item->forHumans,
        //         'hours' => number_format($item->value, 2, ',', ' '),
        //         'activity' => $item->activity instanceof Activity ? $item->activity->name : '-',
        //         'date' => $item->created_at->format(__('Y-m-d g:i A')),
        //         'comment' => $item->comment,
        //     ]);

        return $this->ticket->hours
            ->map(function (TicketHour $item) {
                Assert::notNull($item->created_at);

                return [
                    '#' => $item->ticket?->code,
                    'ticket' => $item->ticket?->name,
                    'user' => $item->user?->name,
                    'time' => $item->forHumans,
                    'hours' => number_format($item->value, 2, ',', ' '),
                    'activity' => $item->activity instanceof Activity ? $item->activity->name : '-',
                    'date' => $item->created_at->format(__('Y-m-d g:i A')),
                    'comment' => $item->comment,
                ];
            });
    }
}
