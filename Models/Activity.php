<?php

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends BaseModel
{
    
    protected $fillable = [
        'name',
        'description'
    ];
}
