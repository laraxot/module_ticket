<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Plugin extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'path', 'status', 'created_at', 'updated_at'];
}
