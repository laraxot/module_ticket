<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 */
class TemplateSet extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'active', 'created_at', 'updated_at'];
}
