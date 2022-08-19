<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $workflow_id
 * @property string $matching_criteria
 * @property string $matching_scenario
 * @property string $matching_relation
 * @property string $matching_value
 * @property string $created_at
 * @property string $updated_at
 * @property WorkflowName $workflowName
 */
class WorkflowRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['workflow_id', 'matching_criteria', 'matching_scenario', 'matching_relation', 'matching_value', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workflowName()
    {
        return $this->belongsTo('App\Models\WorkflowName', 'workflow_id');
    }
}
