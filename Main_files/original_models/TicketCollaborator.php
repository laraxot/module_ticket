<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property boolean $isactive
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 * @property Ticket $ticket
 * @property User $user
 */
class TicketCollaborator extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id', 'isactive', 'role', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
