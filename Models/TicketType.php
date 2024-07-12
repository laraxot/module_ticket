<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $color
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ticket\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Modules\Ticket\Database\Factories\TicketTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketType withoutTrashed()
 * @mixin \Eloquent
 */
class TicketType extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'icon', 'is_default',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'type_id', 'id')->withTrashed();
    }
}
