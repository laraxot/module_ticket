<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Modules\LU\Models\User;
use Modules\Ticket\Models\Ticket;

trait HasTicketTrait {
    public function tickets(): HasMany {
        return Auth::user()->hasMany(Ticket::class);
    }

    /*tickets ha user_id
    profiles ha user_id
    users ha id*/
}
