<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $org_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Organization $organization
 * @property User $user
 */
class UserAssignOrganization extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['org_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
