<?php

declare(strict_types=1);

namespace Modules\Ticket\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketHour;
use Webmozart\Assert\Assert;

class TimesheetExport implements FromCollection, WithHeadings
{
    public function __construct(protected array $params)
    {
    }

    public function headings(): array
    {
        return [
            '#',
            'Project',
            'Ticket',
            'Details',
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

        $hours = TicketHour::where('user_id', auth()->id())
            ->whereBetween('created_at', [$this->params['start_date'], $this->params['end_date']])
            ->get();

        foreach ($hours as $item) {
            Assert::isInstanceOf($item->ticket, Ticket::class);
            Assert::isInstanceOf($item->ticket->project, Project::class);
            Assert::notNull($item->created_at);
            $collection->push([
                '#' => $item->ticket->code,
                'project' => $item->ticket->project->name,
                'ticket' => $item->ticket->name,
                'details' => $item->comment,
                'user' => $item->user?->name,
                'time' => $item->forHumans,
                'hours' => number_format($item->value, 2, ',', ' '),
                'activity' => $item->activity ? $item->activity->name : '-',
                'date' => $item->created_at->format(__('Y-m-d g:i A')),
            ]);
        }

        return $collection;
    }
}
