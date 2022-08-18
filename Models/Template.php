<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $variable
 * @property integer $type
 * @property string $subject
 * @property string $message
 * @property string $description
 * @property integer $set_id
 * @property string $created_at
 * @property string $updated_at
 */
class Template extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'variable', 'type', 'subject', 'message', 'description', 'set_id', 'created_at', 'updated_at'];
}
