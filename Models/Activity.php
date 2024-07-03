<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

class Activity extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];
}
