<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $service_id
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class FaveoQueue extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['service_id', 'key', 'value', 'created_at', 'updated_at'];
}
