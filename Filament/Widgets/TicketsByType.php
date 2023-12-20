<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Widgets\DoughnutChartWidget;
use Modules\Ticket\Models\TicketType;
use Webmozart\Assert\Assert;

class TicketsByType extends DoughnutChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Chart';

    protected static ?string $maxHeight = '300px';

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    public static function canView(): bool
    {
        Assert::notNull(auth()->user());

        return auth()->user()->can('List tickets');
    }

    public function getHeading(): string
    {
        return __('Tickets by types');
    }

    protected function getData(): array
    {
        $data = TicketType::withCount('tickets')->get();

        return [
            'datasets' => [
                [
                    'label' => __('Tickets by types'),
                    'data' => $data->pluck('tickets_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, .6)',
                        'rgba(54, 162, 235, .6)',
                        'rgba(255, 205, 86, .6)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, .8)',
                        'rgba(54, 162, 235, .8)',
                        'rgba(255, 205, 86, .8)',
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }
}
