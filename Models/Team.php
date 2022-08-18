<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $team_lead
 * @property string $name
 * @property boolean $status
 * @property boolean $assign_alert
 * @property string $admin_notes
 * @property string $created_at
 * @property string $updated_at
 * @property TeamAssignAgent[] $teamAssignAgents
 * @property User $user
 * @property Ticket[] $tickets
 */
class Team extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['team_lead', 'name', 'status', 'assign_alert', 'admin_notes', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamAssignAgents()
    {
        return $this->hasMany('App\Models\TeamAssignAgent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'team_lead');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
