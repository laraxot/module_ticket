<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $state
 * @property integer $mode
 * @property string $message
 * @property integer $flags
 * @property integer $sort
 * @property integer $email_user
 * @property string $icon_class
 * @property string $properties
 * @property string $created_at
 * @property string $updated_at
 * @property HelpTopic[] $helpTopics
 * @property Ticket[] $tickets
 */
class TicketStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'state', 'mode', 'message', 'flags', 'sort', 'email_user', 'icon_class', 'properties', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'ticket_status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'status');
    }
}
