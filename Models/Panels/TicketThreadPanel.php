<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels;

use Illuminate\Http\Request;
use Modules\Xot\Contracts\RowsContract;
// --- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

class TicketThreadPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'TicketThread';

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
     * @param TicketThread $row
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
        // return $query->where('user_id', $request->user()->id);
        return $query;
    }

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
    public function fields(): array {
        return [
            0 => (object) [
                'type' => 'Text',
                'name' => 'ticket_id',
                'comment' => 'not in Doctrine',
            ],
            1 => (object) [
                'type' => 'Text',
                'name' => 'user_id',
                'comment' => 'not in Doctrine',
            ],
            2 => (object) [
                'type' => 'Text',
                'name' => 'source',
                'comment' => 'not in Doctrine',
            ],
            3 => (object) [
                'type' => 'Text',
                'name' => 'poster',
                'comment' => 'not in Doctrine',
            ],
            4 => (object) [
                'type' => 'Text',
                'name' => 'reply_rating',
                'comment' => 'not in Doctrine',
            ],
            5 => (object) [
                'type' => 'Text',
                'name' => 'rating_count',
                'comment' => 'not in Doctrine',
            ],
            6 => (object) [
                'type' => 'Text',
                'name' => 'is_internal',
                'comment' => 'not in Doctrine',
            ],
            7 => (object) [
                'type' => 'Text',
                'name' => 'title',
                'comment' => 'not in Doctrine',
            ],
            8 => (object) [
                'type' => 'Text',
                'name' => 'body',
                'comment' => 'not in Doctrine',
            ],
            9 => (object) [
                'type' => 'Text',
                'name' => 'format',
                'comment' => 'not in Doctrine',
            ],
            10 => (object) [
                'type' => 'Text',
                'name' => 'ip_address',
                'comment' => 'not in Doctrine',
            ],
            11 => (object) [
                'type' => 'Text',
                'name' => 'created_at',
                'comment' => 'not in Doctrine',
            ],
            12 => (object) [
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
        return [];
    }
}
