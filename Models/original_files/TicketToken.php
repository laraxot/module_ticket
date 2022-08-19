<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 */
class TicketToken extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'token', 'created_at', 'updated_at'];
}
