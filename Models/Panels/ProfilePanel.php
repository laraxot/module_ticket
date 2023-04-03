<?php

namespace Modules\Ticket\Models\Panels;

use Modules\LU\Models\User;
use Illuminate\Http\Request;
use Modules\Xot\Contracts\RowsContract;


use Modules\Cms\Models\Panels\XotBasePanel;
use Illuminate\Contracts\Support\Renderable;

class ProfilePanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = 'Profile';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static string $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = array (
);

    /**
     * The relationships that should be eager loaded on index queries.
     *
     */
    public function with():array {
        return [];
    }

    public function search() :array {

        return [];
    }

    /**
     * on select the option id
     *
     * quando aggiungi un campo select, è il numero della chiave
     * che viene messo come valore su value="id"
     *
     * @param Profile $row
     *
     * @return int|string|null
     */
    public function optionId($row) {
        $key = $row->getKey();
        if(null===$key||(!is_string($key)&&!is_int($key))){
            throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        return $key;
    }

    /**
     * on select the option label.
     *
     * @param Profile $row
     */
    public function optionLabel($row):string {
        return 'To Set';
    }

    /**
     * index navigation.
     */
    public function indexNav(): ?Renderable {
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
        //return $query->where('user_id', $request->user()->id);
        return $query;
    }



    /**
     * Get the fields displayed by the resource.
     *
     * @return array
        'col_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
        'value'=>'..',
     */
    public function fields(): array {
        return array (
  0 => 
  (object) array(
     'type' => 'Id',
     'name' => 'id',
     'comment' => NULL,
  ),
  1 => 
  (object) array(
     'type' => 'Integer',
     'name' => 'user_id',
     'comment' => NULL,
  ),
  2 => 
  (object) array(
     'type' => 'String',
     'name' => 'phone',
     'comment' => NULL,
  ),
  3 => 
  (object) array(
     'type' => 'String',
     'name' => 'email',
     'comment' => NULL,
  ),
  4 => 
  (object) array(
     'type' => 'Text',
     'name' => 'bio',
     'comment' => NULL,
  ),
);
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs():array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request):array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request = null):array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request):array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions():array {
        return [];
    }

        public function isSuperAdmin(): bool {
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
