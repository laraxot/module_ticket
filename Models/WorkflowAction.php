<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $workflow_id
 * @property string $condition
 * @property string $action
 * @property string $created_at
 * @property string $updated_at
 * @property WorkflowName $workflowName
 */
class WorkflowAction extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['workflow_id', 'condition', 'action', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workflowName()
    {
        return $this->belongsTo('App\Models\WorkflowName', 'workflow_id');
    }
}
