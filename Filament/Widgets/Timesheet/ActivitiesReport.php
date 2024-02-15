<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets\Timesheet;

use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Datas\TrendActivityData;
use Modules\Ticket\Models\TicketHour;
use Modules\User\Models\User;
use Spatie\LaravelData\DataCollection;
use Webmozart\Assert\Assert;

// class ActivitiesReport extends BarChartWidget
class ActivitiesReport extends ChartWidget
{
    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    protected function getType(): string
    {
        return 'bar';
    }

    public ?string $filter = '2023';

    public function getHeading(): string
    {
        return __('Logged time by activity');
    }

    protected function getFilters(): ?array
    {
        return [
            2022 => 2022,
            2023 => 2023,
        ];
    }

    protected function getData(): array
    {
        Assert::notNull(auth()->user());
        $collection = $this->filter(auth()->user(), [
            'year' => $this->filter,
        ]);

        $datasets = $this->getDatasets($collection);

        return [
            'datasets' => [
                [
                    'label' => __('Total time logged'),
                    'data' => $datasets['sets'],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, .6)',
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, .8)',
                    ],
                ],
            ],
            'labels' => $datasets['labels'],
        ];
    }

    /**
     * @param DataCollection<TrendActivityData> $collection
     */
    protected function getDatasets(DataCollection $collection): array
    {
        $datasets = [
            'sets' => [],
            'labels' => [],
        ];

        foreach ($collection as $item) {
            $datasets['sets'][] = $item->value;
            $datasets['labels'][] = $item->activity?->name ?? __('No activity');
        }

        return $datasets;
    }

    /**
     * @return DataCollection<TrendActivityData>
     */
    protected function filter(User $user, array $params): DataCollection
    {
        $res = TicketHour::with('activity')
            ->select([
                'activity_id',
                DB::raw('SUM(value) as value'),
            ])
            ->whereRaw(
                'YEAR(created_at)='.($params['year'] ?? Carbon::now()->format('Y'))
            )
            ->where('user_id', $user->id)
            ->groupBy('activity_id')
            ->get();

        /**
         * @var DataCollection<TrendActivityData>
         */
        $res_coll = TrendActivityData::collect($res->toArray(), DataCollection::class);

        return $res_coll;
    }
}
