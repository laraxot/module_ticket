<?php

declare(strict_types=1);

namespace Modules\Ticket\Datas;

use Spatie\LaravelData\Data;

class TrendDayData extends Data
{
    public string $day;
    public int $value;
}
