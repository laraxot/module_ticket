<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $order
 * @property string $target
 * @property string $internal_note
 * @property string $created_at
 * @property string $updated_at
 * @property WorkflowAction[] $workflowActions
 * @property WorkflowRule[] $workflowRules
 */
class WorkflowName extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'order', 'target', 'internal_note', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workflowActions()
    {
        return $this->hasMany('App\Models\WorkflowAction', 'workflow_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workflowRules()
    {
        return $this->hasMany('App\Models\WorkflowRule', 'workflow_id');
    }
}
