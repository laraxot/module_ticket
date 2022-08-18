<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $rating_name
 * @property integer $publish
 * @property integer $modify
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsRating extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rating_name', 'publish', 'modify', 'slug', 'created_at', 'updated_at'];
}
