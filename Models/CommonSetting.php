<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $option_name
 * @property string $option_value
 * @property string $status
 * @property string $optional_field
 * @property string $created_at
 * @property string $updated_at
 */
class CommonSetting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['option_name', 'option_value', 'status', 'optional_field', 'created_at', 'updated_at'];
}
