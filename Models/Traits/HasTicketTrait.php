<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
// //use Laravel\Scout\Searchable;

// ----- models------
use Illuminate\Support\Facades\Auth;
// ----- relations------
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// ---- services -----
//use Modules\Rating\Models\Rating;
use Modules\Xot\Services\PanelService as Panel;
use Modules\Ticket\Models\Ticket;
use Modules\LU\Models\User;


// ------ traits ---

trait HasTicketTrait {

    // ------- RELATIONSHIP ----------

    public function tickets(): HasMany {
        return Auth::user()->hasMany(Ticket::class);
    }

    /*tickets ha user_id
    profiles ha user_id
    users ha id*/

}// end model
