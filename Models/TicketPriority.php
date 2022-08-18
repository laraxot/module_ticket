<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $priority_id
 * @property string $priority
 * @property string $status
 * @property string $priority_desc
 * @property string $priority_color
 * @property boolean $priority_urgency
 * @property boolean $ispublic
 * @property string $is_default
 * @property string $created_at
 * @property string $updated_at
 * @property Email[] $emails
 * @property HelpTopic[] $helpTopics
 * @property Ticket[] $tickets
 */
class TicketPriority extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'priority_id';

    /**
     * @var array
     */
    protected $fillable = ['priority', 'status', 'priority_desc', 'priority_color', 'priority_urgency', 'ispublic', 'is_default', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('App\Models\Email', 'priority', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'priority', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'priority_id', 'priority_id');
    }
}
