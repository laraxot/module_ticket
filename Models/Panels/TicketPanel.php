<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Xot\Contracts\RowsContract;
// --- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

class TicketPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Ticket';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     */
    public function with(): array {
        return [];
    }

    public function search(): array {
        return [];
    }

    /**
     * on select the option id.
     *
     * quando aggiungi un campo select, è il numero della chiave
     * che viene messo come valore su value="id"
     *
     * @param Ticket $row
     *
     * @return int|string|null
     */
    public function optionId($row) {
        return $row->getKey();
    }

    /**
     * on select the option label.
     */
    public function optionLabel($row): string {
        return (string) $row->title;
    }

    /**
     * index navigation.
     */
    public function indexNav(): ?\Illuminate\Contracts\Support\Renderable {
        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function indexQuery(array $data, $query) {
        return $query->where('user_id', Auth::id());
    }

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
    public function fields(): array {
        return [
            0 => (object) [
                'type' => 'Text',
                'name' => 'user_id',
                'comment' => 'not in Doctrine',
            ],
            1 => (object) [
                'type' => 'Text',
                'name' => 'dept_id',
                'comment' => 'not in Doctrine',
            ],
            2 => (object) [
                'type' => 'Text',
                'name' => 'team_id',
                'comment' => 'not in Doctrine',
            ],
            3 => (object) [
                'type' => 'Text',
                'name' => 'priority_id',
                'comment' => 'not in Doctrine',
            ],
            4 => (object) [
                'type' => 'Text',
                'name' => 'sla',
                'comment' => 'not in Doctrine',
            ],
            5 => (object) [
                'type' => 'Text',
                'name' => 'help_topic_id',
                'comment' => 'not in Doctrine',
            ],
            6 => (object) [
                'type' => 'Text',
                'name' => 'status',
                'comment' => 'not in Doctrine',
            ],
            7 => (object) [
                'type' => 'Text',
                'name' => 'assigned_to',
                'comment' => 'not in Doctrine',
            ],
            8 => (object) [
                'type' => 'Text',
                'name' => 'source',
                'comment' => 'not in Doctrine',
            ],
            9 => (object) [
                'type' => 'Text',
                'name' => 'ticket_number',
                'comment' => 'not in Doctrine',
            ],
            10 => (object) [
                'type' => 'Text',
                'name' => 'rating',
                'comment' => 'not in Doctrine',
            ],
            11 => (object) [
                'type' => 'Text',
                'name' => 'ratingreply',
                'comment' => 'not in Doctrine',
            ],
            12 => (object) [
                'type' => 'Text',
                'name' => 'flags',
                'comment' => 'not in Doctrine',
            ],
            13 => (object) [
                'type' => 'Text',
                'name' => 'ip_address',
                'comment' => 'not in Doctrine',
            ],
            14 => (object) [
                'type' => 'Text',
                'name' => 'lock_by',
                'comment' => 'not in Doctrine',
            ],
            15 => (object) [
                'type' => 'Text',
                'name' => 'lock_at',
                'comment' => 'not in Doctrine',
            ],
            16 => (object) [
                'type' => 'Text',
                'name' => 'isoverdue',
                'comment' => 'not in Doctrine',
            ],
            17 => (object) [
                'type' => 'Text',
                'name' => 'reopened',
                'comment' => 'not in Doctrine',
            ],
            18 => (object) [
                'type' => 'Text',
                'name' => 'isanswered',
                'comment' => 'not in Doctrine',
            ],
            19 => (object) [
                'type' => 'Text',
                'name' => 'html',
                'comment' => 'not in Doctrine',
            ],
            20 => (object) [
                'type' => 'Text',
                'name' => 'is_deleted',
                'comment' => 'not in Doctrine',
            ],
            21 => (object) [
                'type' => 'Text',
                'name' => 'closed',
                'comment' => 'not in Doctrine',
            ],
            22 => (object) [
                'type' => 'Text',
                'name' => 'is_transferred',
                'comment' => 'not in Doctrine',
            ],
            23 => (object) [
                'type' => 'Text',
                'name' => 'transferred_at',
                'comment' => 'not in Doctrine',
            ],
            24 => (object) [
                'type' => 'Text',
                'name' => 'reopened_at',
                'comment' => 'not in Doctrine',
            ],
            25 => (object) [
                'type' => 'Text',
                'name' => 'duedate',
                'comment' => 'not in Doctrine',
            ],
            26 => (object) [
                'type' => 'Text',
                'name' => 'closed_at',
                'comment' => 'not in Doctrine',
            ],
            27 => (object) [
                'type' => 'Text',
                'name' => 'last_message_at',
                'comment' => 'not in Doctrine',
            ],
            28 => (object) [
                'type' => 'Text',
                'name' => 'last_response_at',
                'comment' => 'not in Doctrine',
            ],
            29 => (object) [
                'type' => 'Text',
                'name' => 'approval',
                'comment' => 'not in Doctrine',
            ],
            30 => (object) [
                'type' => 'Text',
                'name' => 'follow_up',
                'comment' => 'not in Doctrine',
            ],
            31 => (object) [
                'type' => 'Text',
                'name' => 'created_at',
                'comment' => 'not in Doctrine',
            ],
            32 => (object) [
                'type' => 'Text',
                'name' => 'updated_at',
                'comment' => 'not in Doctrine',
            ],
        ];
    }

    /**
     * Get the tabs available.
     */
    public function tabs(): array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(Request $request): array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function filters(Request $request = null): array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(Request $request): array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array {
        return [
            new Actions\CreateAction(),
        ];
    }
}