<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custom_form
 * @property integer $department
 * @property integer $ticket_status
 * @property integer $priority
 * @property integer $sla_plan
 * @property integer $auto_assign
 * @property string $topic
 * @property string $parent_topic
 * @property string $thank_page
 * @property string $ticket_num_format
 * @property string $internal_notes
 * @property boolean $status
 * @property boolean $type
 * @property boolean $auto_response
 * @property string $created_at
 * @property string $updated_at
 * @property Email[] $emails
 * @property TicketPriority $ticketPriority
 * @property User $user
 * @property CustomForm $customForm
 * @property TicketStatus $ticketStatus
 * @property SlaPlan $slaPlan
 * @property Department $department
 * @property Ticket[] $tickets
 */
class HelpTopic extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['custom_form', 'department', 'ticket_status', 'priority', 'sla_plan', 'auto_assign', 'topic', 'parent_topic', 'thank_page', 'ticket_num_format', 'internal_notes', 'status', 'type', 'auto_response', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('App\Models\Email', 'help_topic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketPriority()
    {
        return $this->belongsTo('App\Models\TicketPriority', 'priority', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'auto_assign');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customForm()
    {
        return $this->belongsTo('App\Models\CustomForm', 'custom_form');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketStatus()
    {
        return $this->belongsTo('App\Models\TicketStatus', 'ticket_status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slaPlan()
    {
        return $this->belongsTo('App\Models\SlaPlan', 'sla_plan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
