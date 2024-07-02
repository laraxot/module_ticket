<?php

namespace Modules\Ticket\Models;

use Carbon\CarbonInterval;
use Modules\Xot\Datas\XotData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketHour extends BaseModel
{
    

    protected $fillable = [
        'user_id', 'ticket_id', 'value', 'comment', 'activity_id'
    ];

    public function user(): BelongsTo
    {
        $user_class=XotData::make()->getUserClass();
        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }

    public function forHumans(): Attribute
    {
        return new Attribute(
            get: function () {
                $seconds = $this->value * 3600;
                return CarbonInterval::seconds($seconds)->cascade()->forHumans();
            }
        );
    }
}
