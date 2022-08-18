<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $model_id
 * @property integer $userid_created
 * @property integer $type_id
 * @property string $created_at
 * @property string $updated_at
 */
class Notification extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['model_id', 'userid_created', 'type_id', 'created_at', 'updated_at'];
}
