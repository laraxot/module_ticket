<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $team_id
 * @property integer $agent_id
 * @property string $created_at
 * @property string $updated_at
 * @property Team $team
 * @property User $user
 */
class TeamAssignAgent extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['team_id', 'agent_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'agent_id');
    }
}
