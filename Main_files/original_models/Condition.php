<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $job
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class Condition extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['job', 'value', 'created_at', 'updated_at'];
}
