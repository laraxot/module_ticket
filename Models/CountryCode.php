<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string $iso3
 * @property integer $numcode
 * @property integer $phonecode
 * @property string $created_at
 * @property string $updated_at
 */
class CountryCode extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['iso', 'name', 'nicename', 'iso3', 'numcode', 'phonecode', 'created_at', 'updated_at'];
}
