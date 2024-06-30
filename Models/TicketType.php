<?php

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends BaseModel
{
    

    protected $fillable = [
        'name', 'color', 'icon', 'is_default'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'type_id', 'id')->withTrashed();
    }
}
