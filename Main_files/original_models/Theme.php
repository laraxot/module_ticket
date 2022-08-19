<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property boolean $status
 * @property string $template_set_to_clone
 * @property string $language
 * @property string $internal_note
 * @property string $created_at
 * @property string $updated_at
 */
class Theme extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'template_set_to_clone', 'language', 'internal_note', 'created_at', 'updated_at'];
}
