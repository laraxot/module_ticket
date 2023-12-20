<?php
/**
 * ---.
 */
declare(strict_types=1);

namespace Modules\Ticket\Actions\Project;

use Spatie\QueueableAction\QueueableAction;

class GetOptionsByUserIdAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $user_id): array
    {
        $builder = app(GetBuilderByUserIdAction::class)->execute($user_id);

        return [];
    }
}
