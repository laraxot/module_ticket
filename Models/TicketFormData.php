<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property Ticket $ticket
 */
class TicketFormData extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'title', 'content', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }
}
