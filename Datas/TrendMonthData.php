<?php

declare(strict_types=1);

namespace Modules\Ticket\Datas;

use Spatie\LaravelData\Data;

class TrendMonthData extends Data
{
    public string $month;

    public int $value;
}
