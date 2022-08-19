<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $locale
 */
class Language extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'locale'];
}
