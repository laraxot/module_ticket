<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class Widget extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'title', 'value', 'created_at', 'updated_at'];
}
