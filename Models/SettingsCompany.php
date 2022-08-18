<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $company_name
 * @property string $website
 * @property string $phone
 * @property string $address
 * @property string $landing_page
 * @property string $offline_page
 * @property string $thank_page
 * @property string $logo
 * @property string $use_logo
 * @property string $created_at
 * @property string $updated_at
 */
class SettingsCompany extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['company_name', 'website', 'phone', 'address', 'landing_page', 'offline_page', 'thank_page', 'logo', 'use_logo', 'created_at', 'updated_at'];
}
