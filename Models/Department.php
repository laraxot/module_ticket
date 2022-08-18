<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $sla
 * @property integer $manager
 * @property string $name
 * @property string $type
 * @property string $ticket_assignment
 * @property string $outgoing_email
 * @property string $template_set
 * @property string $auto_ticket_response
 * @property string $auto_message_response
 * @property string $auto_response_email
 * @property string $recipient
 * @property string $group_access
 * @property string $department_sign
 * @property string $created_at
 * @property string $updated_at
 * @property SlaPlan $slaPlan
 * @property User $user
 * @property Email[] $emails
 * @property GroupAssignDepartment[] $groupAssignDepartments
 * @property HelpTopic[] $helpTopics
 * @property Ticket[] $tickets
 * @property User[] $users
 */
class Department extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['sla', 'manager', 'name', 'type', 'ticket_assignment', 'outgoing_email', 'template_set', 'auto_ticket_response', 'auto_message_response', 'auto_response_email', 'recipient', 'group_access', 'department_sign', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slaPlan()
    {
        return $this->belongsTo('App\Models\SlaPlan', 'sla');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'manager');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('App\Models\Email', 'department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupAssignDepartments()
    {
        return $this->hasMany('App\Models\GroupAssignDepartment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'dept_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'primary_dpt');
    }
}
