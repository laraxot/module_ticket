<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modules\Ticket\Models\TicketPriority.
 *
 * @property string $name
 *
 * @mixin \Eloquent
 */
class TicketPriority extends BaseModel
{
    protected $fillable = [
        'name', 'color', 'is_default',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'priority_id', 'id')->withTrashed();
    }
}
