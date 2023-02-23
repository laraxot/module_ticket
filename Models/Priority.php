<?php

<<<<<<< HEAD

declare(strict_types=1);

namespace Modules\Ticket\Models;

=======
declare(strict_types=1);

namespace Modules\Ticket\Models;
>>>>>>> 2bae9b4 (up)

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Priority.
 */
class Priority extends Model
{
    use SoftDeletes;

    public $table = 'priorities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'color',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class, 'priority_id', 'id');
    }
}
