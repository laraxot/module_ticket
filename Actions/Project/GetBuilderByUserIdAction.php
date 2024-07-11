<?php
/**
 * ---.
 */
declare(strict_types=1);

namespace Modules\Ticket\Actions\Project;

use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Models\Project;
use Spatie\QueueableAction\QueueableAction;

class GetBuilderByUserIdAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $user_id): Builder
    {
        /*
        return Project::where(static function ($query) use ($user_id) {
            return $query->where('owner_id', $user_id)
                ->orWhereHas('users', static function ($query) use ($user_id) {
                    return $query->where('users.id', $user_id);
                });
        });
        */
        return Project::query();
    }
}
