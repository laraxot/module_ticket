<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $group_id
 * @property integer $department_id
 * @property string $created_at
 * @property string $updated_at
 * @property Group $group
 * @property Department $department
 */
class GroupAssignDepartment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['group_id', 'department_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
