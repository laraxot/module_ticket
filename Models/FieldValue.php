<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $field_id
 * @property integer $child_id
 * @property string $field_key
 * @property string $field_value
 * @property string $created_at
 * @property string $updated_at
 * @property CustomFormField $customFormField
 */
class FieldValue extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['field_id', 'child_id', 'field_key', 'field_value', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customFormField()
    {
        return $this->belongsTo('App\Models\CustomFormField', 'field_id');
    }
}
