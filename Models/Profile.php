<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

// --------- models --------

use Illuminate\Database\Eloquent\Factories\HasFactory;
// --- TRAITS ---
use Modules\LU\Models\Traits\HasProfileTrait;
use Modules\Xot\Contracts\ModelProfileContract;
use Modules\Xot\Models\Traits\WidgetTrait;
use Spatie\Permission\Traits\HasRoles;

class Profile extends BaseModel implements ModelProfileContract {
    // use PrivacyTrait;
    use HasFactory;
    // use GeoTrait;
    use HasProfileTrait;
    // use WidgetTrait;
    use HasRoles;

    protected $connection = 'mysql';

    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id', 'phone', 'email', 'bio'];

    // ------- RELATIONSHIP ----------
}// end model
