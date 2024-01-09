<?php

declare(strict_types=1);

namespace Modules\Ticket\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Ticket\Models\Activity;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\TicketHour;
use Webmozart\Assert\Assert;

class ProjectHoursExport implements FromCollection, WithHeadings
{
    public function __construct(public Project $project)
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
        ];
    }

    public function collection(): Collection
    {
        $collection = collect();
        // $this->project->tickets
        //     ->filter(static fn ($ticket) => $ticket->hours()->count())
        //     ->each(static fn ($ticket) => $ticket->hours
        //             ->each(static fn (TicketHour $item) => $collection->push([
        //                 '#' => $item->ticket?->code,
        //                 'ticket' => $item->ticket?->name,
        //                 'user' => $item->user?->name,
        //                 'time' => $item->forHumans,
        //                 'hours' => number_format($item->value, 2, ',', ' '),
        //                 'activity' => $item->activity instanceof Activity ? $item->activity->name : '-',
        //                 'date' => $item->created_at->format(__('Y-m-d g:i A')),
        //             ]))
        //     );

        $this->project->tickets
            ->filter(static fn ($ticket) => $ticket->hours()->count())
            ->each(static fn ($ticket) => $ticket->hours
<<<<<<< HEAD
                ->each(function (TicketHour $item) use ($collection) {
                    Assert::notNull($item->created_at);

                    return $collection->push([
                        '#' => $item->ticket?->code,
                        'ticket' => $item->ticket?->name,
                        'user' => $item->user?->name,
                        'time' => $item->forHumans,
                        'hours' => number_format($item->value, 2, ',', ' '),
                        'activity' => $item->activity instanceof Activity ? $item->activity->name : '-',
                        'date' => $item->created_at->format(__('Y-m-d g:i A')),
                    ]);
                })
=======
                    ->each(function (TicketHour $item) use ($collection) {
                        Assert::notNull($item->created_at);

                        return $collection->push([
                            '#' => $item->ticket?->code,
                            'ticket' => $item->ticket?->name,
                            'user' => $item->user?->name,
                            'time' => $item->forHumans,
                            'hours' => number_format($item->value, 2, ',', ' '),
                            'activity' => $item->activity instanceof Activity ? $item->activity->name : '-',
                            'date' => $item->created_at->format(__('Y-m-d g:i A')),
                        ]);
                    })
>>>>>>> dev
            );

        return $collection;
    }
}
