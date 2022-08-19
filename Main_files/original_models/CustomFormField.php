<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $forms_id
 * @property string $label
 * @property string $name
 * @property string $type
 * @property string $value
 * @property string $required
 * @property string $created_at
 * @property string $updated_at
 * @property FieldValue[] $fieldValues
 */
class CustomFormField extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['forms_id', 'label', 'name', 'type', 'value', 'required', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fieldValues()
    {
        return $this->hasMany('App\Models\FieldValue', 'field_id');
    }
}
