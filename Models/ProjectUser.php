<?php

namespace Modules\Ticket\Models;

use Modules\Xot\Datas\XotData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectUser extends BAsePivot
{
    

    protected $fillable = [
        'user_id', 'project_id', 'role'
    ];

    public function user(): BelongsTo
    {
        $user_class=XotData::make()->getUserClass();
        return $this->belongsTo($user_class, 'user_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withTrashed();
    }
}
