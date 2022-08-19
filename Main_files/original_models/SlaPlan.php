<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $grace_period
 * @property string $admin_note
 * @property boolean $status
 * @property boolean $transient
 * @property boolean $ticket_overdue
 * @property string $created_at
 * @property string $updated_at
 * @property Department[] $departments
 * @property HelpTopic[] $helpTopics
 * @property Ticket[] $tickets
 */
class SlaPlan extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'grace_period', 'admin_note', 'status', 'transient', 'ticket_overdue', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany('App\Models\Department', 'sla');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpTopics()
    {
        return $this->hasMany('App\Models\HelpTopic', 'sla_plan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'sla');
    }
}
