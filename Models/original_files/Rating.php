<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $display_order
 * @property integer $allow_modification
 * @property integer $rating_scale
 * @property string $rating_area
 * @property string $restrict
 * @property string $created_at
 * @property string $updated_at
 */
class Rating extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'display_order', 'allow_modification', 'rating_scale', 'rating_area', 'restrict', 'created_at', 'updated_at'];
}
