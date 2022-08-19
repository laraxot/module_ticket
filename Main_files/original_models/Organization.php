<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $head
 * @property string $name
 * @property string $phone
 * @property string $website
 * @property string $address
 * @property string $internal_notes
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property UserAssignOrganization[] $userAssignOrganizations
 */
class Organization extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['head', 'name', 'phone', 'website', 'address', 'internal_notes', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'head');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAssignOrganizations()
    {
        return $this->hasMany('App\Models\UserAssignOrganization', 'org_id');
    }
}
