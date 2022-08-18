<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property boolean $status
 * @property boolean $visibility
 * @property string $slug
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class KbPage extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'visibility', 'slug', 'description', 'created_at', 'updated_at'];
}
