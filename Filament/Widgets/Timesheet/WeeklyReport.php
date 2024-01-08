<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets\Timesheet;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Datas\TrendDayData;
use Modules\Ticket\Models\TicketHour;
use Modules\User\Models\User;
use Spatie\LaravelData\DataCollection;
use Webmozart\Assert\Assert;

// class WeeklyReport extends BarChartWidget
class WeeklyReport extends ChartWidget
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

    public function __construct(public ?string $id = null)
    {
        $weekDaysData = $this->getWeekStartAndFinishDays();

        $this->filter = $weekDaysData['weekStartDate'].' - '.$weekDaysData['weekEndDate'];
        // parent::__construct($id);
    }

    public function getHeading(): string
    {
        return __('Weekly logged time');
    }

    protected function getData(): array
    {
        Assert::notNull($this->filter);
        $weekDaysData = explode(' - ', $this->filter);
        Assert::notNull(auth()->user());
        $collection = $this->filter(auth()->user(), [
            'year' => null,
            'weekStartDate' => $weekDaysData[0],
            'weekEndDate' => $weekDaysData[1],
        ]);

        $dates = $this->buildDatesRange($weekDaysData[0], $weekDaysData[1]);

        $datasets = $this->buildRapport($collection, $dates);

        return [
            'datasets' => [
                [
                    'label' => __('Weekly time logged'),
                    'data' => $datasets,
                    'backgroundColor' => [
                        'rgba(54, 162, 235, .6)',
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, .8)',
                    ],
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getFilters(): ?array
    {
        return $this->yearWeeks();
    }

    /**
     * @param  DataCollection<TrendDayData>  $collection
     */
    protected function buildRapport(DataCollection $collection, array $dates): array
    {
        $template = $this->createReportTemplate($dates);
        foreach ($collection as $item) {
            $template[$item->day]['value'] = $item->value;
        }

        return collect($template)->pluck('value')->toArray();
    }

    /**
     * @return DataCollection<TrendDayData>
     */
    protected function filter(User $user, array $params): DataCollection
    {
        $res = TicketHour::select([
            DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as day"),
            DB::raw('SUM(value) as value'),
        ])
            ->whereBetween('created_at', [$params['weekStartDate'], $params['weekEndDate']])
            ->whereRaw(
                'YEAR(created_at)='.($params['year'] ?? Carbon::now()->format('Y'))
            )
            ->where('user_id', $user->id)
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"))
            ->get();

        return TrendDayData::collection($res->toArray());
    }

    protected function buildDatesRange(string $weekStartDate, string $weekEndDate): array
    {
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);

        $dates = [];
        foreach ($period as $item) {
            Assert::notNull($item);
            $dates[] = $item->format('Y-m-d');
        }

        return $dates;
    }

    protected function createReportTemplate(array $dates): array
    {
        $template = [];
        foreach ($dates as $date) {
            $template[$date]['value'] = 0;
        }

        return $template;
    }

    protected function yearWeeks(): array
    {
        $year = date_create('today')->format('Y');
        Assert::notFalse(date_create('2 jan '.$year));
        $dtStart = date_create('2 jan '.$year)->modify('last Monday');
        $dtEnd = date_create('last monday of Dec '.$year);

        for ($weeks = []; $dtStart <= $dtEnd; $dtStart->modify('+1 week')) {
            $from = $dtStart->format('Y-m-d');
            $to = (clone $dtStart)->modify('+6 Days')->format('Y-m-d');
            $weeks[$from.' - '.$to] = $from.' - '.$to;
        }

        return $weeks;
    }

    protected function getWeekStartAndFinishDays(): array
    {
        $now = Carbon::now();

        return [
            'weekStartDate' => $now->startOfWeek()->format('Y-m-d'),
            'weekEndDate' => $now->endOfWeek()->format('Y-m-d'),
        ];
    }
}
