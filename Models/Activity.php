<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

/**
 * 
 *
 * @method static \Modules\Ticket\Database\Factories\ActivityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withoutTrashed()
 * @mixin \Eloquent
 */
class Activity extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];
}
