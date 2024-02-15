<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\ActivityFactory;

/**
 * Modules\Ticket\Models\Activity.
 *
 * @method static ActivityFactory  factory($count = null, $state = [])
 * @method static Builder|Activity newModelQuery()
 * @method static Builder|Activity newQuery()
 * @method static Builder|Activity onlyTrashed()
 * @method static Builder|Activity query()
 * @method static Builder|Activity withTrashed()
 * @method static Builder|Activity withoutTrashed()
 * @property int         $id
 * @property string      $name
 * @property string      $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @method static Builder|Activity whereCreatedAt($value)
 * @method static Builder|Activity whereCreatedBy($value)
 * @method static Builder|Activity whereDeletedAt($value)
 * @method static Builder|Activity whereDeletedBy($value)
 * @method static Builder|Activity whereDescription($value)
 * @method static Builder|Activity whereId($value)
 * @method static Builder|Activity whereName($value)
 * @method static Builder|Activity whereUpdatedAt($value)
 * @method static Builder|Activity whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Activity extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];
}
