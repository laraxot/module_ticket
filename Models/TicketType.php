<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modules\Ticket\Models\TicketType.
 *
 * @property string $name
 *
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
