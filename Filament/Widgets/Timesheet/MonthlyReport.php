<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets\Timesheet;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Datas\TrendMonthData;
use Modules\Ticket\Models\TicketHour;
use Modules\User\Models\User;
use Spatie\LaravelData\DataCollection;
use Webmozart\Assert\Assert;

class MonthlyReport extends ChartWidget
{
    public function getHeading(): string
    {
        return __('Logged time monthly');
    }

    public ?string $filter = '2023';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        Assert::notNull(auth()->user());
        $collection = $this->filter(auth()->user(), [
            'year' => $this->filter,
        ]);

        $datasets = $this->getDatasets($this->buildRapport($collection));

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

    protected function getFilters(): ?array
    {
        return [
            2022 => 2022,
            2023 => 2023,
        ];
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
    ];

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'md' => 6,
        'lg' => 3,
    ];

    /**
     * @return DataCollection<TrendMonthData> $collection
     */
    protected function filter(User $user, array $params): DataCollection
    {
        $res = TicketHour::select([
            DB::raw("DATE_FORMAT(created_at,'%m') as month"),
            DB::raw('SUM(value) as value'),
        ])
            ->whereRaw(
                'YEAR(created_at)='.($params['year'] ?? Carbon::now()->format('Y'))
            )
            ->where('user_id', $user->id)
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%m')"))
            ->get();

        /**
         * @var DataCollection<TrendMonthData>
         */
        $res_coll = TrendMonthData::collect($res,DataCollection::class);

        return $res_coll;
    }

    protected function getDatasets(array $rapportData): array
    {
        $datasets = [
            'sets' => [],
            'labels' => [],
        ];

        foreach ($rapportData as $data) {
            $datasets['sets'][] = $data[1];
            $datasets['labels'][] = $data[0];
        }

        return $datasets;
    }

    /**
     * @param DataCollection<TrendMonthData> $collection
     */
    protected function buildRapport(DataCollection $collection): array
    {
        $months = [
            1 => ['January', 0],
            2 => ['February', 0],
            3 => ['March', 0],
            4 => ['April', 0],
            5 => ['May', 0],
            6 => ['June', 0],
            7 => ['July', 0],
            8 => ['August', 0],
            9 => ['September', 0],
            10 => ['October', 0],
            11 => ['November', 0],
            12 => ['December', 0],
        ];

        foreach ($collection as $value) {
            if (isset($months[(int) $value->month])) {
                $months[(int) $value->month][1] = (float) $value->value;
            }
        }

        return $months;
    }
}
