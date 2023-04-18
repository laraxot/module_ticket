<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Cms\Models\Panels\XotBasePanel;
use Modules\LU\Models\User;
use Modules\Ticket\Models\Profile;
use Modules\Xot\Contracts\RowsContract;

class ProfilePanel extends XotBasePanel
{
    public array $vars = [];
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Profile';

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
    public function with(): array
    {
        return [];
    }

    public function search(): array
    {
        return [];
    }

    /**
     * on select the option label.
     *
     * @param Profile $row
     */
    public function optionLabel($row): string
    {
        return 'To Set';
    }

    /**
     * index navigation.
     */
    public function indexNav(): ?Renderable
    {
        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public function indexQuery(array $data, $query)
    {
        // return $query->where('user_id', $request->user()->id);
        return $query;
    }

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
    public function fields(): array
    {
        return [
            0 => (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],
            1 => (object) [
                'type' => 'Integer',
                'name' => 'user_id',
                'comment' => null,
            ],
            2 => (object) [
                'type' => 'String',
                'name' => 'phone',
                'comment' => null,
            ],
            3 => (object) [
                'type' => 'String',
                'name' => 'email',
                'comment' => null,
            ],
            4 => (object) [
                'type' => 'Text',
                'name' => 'bio',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the tabs available.
     */
    public function tabs(): array
    {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function filters(Request $request = null): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array
    {
        return [];
    }

        public function isSuperAdmin(): bool
        {
            if (isset($this->vars[__FUNCTION__])) {
                return $this->vars[__FUNCTION__];
            }

            // 232 Access to an undefined property Illuminate\Database\Eloquent\Model::$user.
            // $user = $this->row->user;
            // $user = $this->row->getRelationValue('user');
            // 89     Access to an undefined property object::$perm_type
            $user_id = $this->row->getAttributeValue('user_id');
            $user = User::where('id', $user_id)->first();
            if (null == $user) {
                throw new \Exception('['.__LINE__.']['.__FILE__.']');
            }
            try {
                if (\is_object($user->perm) && $user->perm->perm_type >= 4) {  // superadmin
                    $this->vars[__FUNCTION__] = true;

                    return true;
                }
            } catch (\Exception $e) {
                $this->vars[__FUNCTION__] = false;

                return false;
            }

            $this->vars[__FUNCTION__] = false;

            return false;
        }
}
