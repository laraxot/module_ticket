<?php

declare(strict_types=1);

namespace Modules\Ticket\Models;

// use Modules\Rating\Models\Traits\RatingTrait;
// ------services---------
// --- TRAITS ---
use Modules\Xot\Models\Traits\WidgetTrait;
use Sushi\Sushi;

/**
 * Modules\Blog\Models\Home.
 *
 * @property int|null                                                                  $id
 * @property string|null                                                               $name
 * @property string|null                                                               $icon_src
 * @property string|null                                                               $created_by
 * @property string|null                                                               $updated_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Xot\Models\Widget> $containerWidgets
 * @property int|null                                                                  $container_widgets_count
 * @property string|null                                                               $guid
 * @property string|null                                                               $image_src
 * @property string|null                                                               $lang
 * @property string|null                                                               $post_type
 * @property string|null                                                               $subtitle
 * @property string|null                                                               $title
 * @property string|null                                                               $txt
 * @property string|null                                                               $user_handle
 * @property \Modules\Lang\Models\Post|null                                            $post
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Lang\Models\Post>  $posts
 * @property int|null                                                                  $posts_count
 * @property mixed                                                                     $url
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Xot\Models\Widget> $widgets
 * @property int|null                                                                  $widgets_count
 *
 * @method static \Modules\Blog\Database\Factories\HomeFactory        factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Home          newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Home          newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem(string $guid)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          ofLayoutPosition($layout_position)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          query()
 * @method static \Illuminate\Database\Eloquent\Builder|Home          whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          whereIconSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home          whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost(string $guid)
 *
 * @mixin \Eloquent
 */
class Home extends BaseModelLang {
    use Sushi;
    use WidgetTrait;

    // use RatingTrait; // non si vota la home
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'name', 'icon_src', 'created_by', 'updated_by'];

    /**
     * Undocumented variable.
     *
     * @var array<int, array<string, string>>
     */
    protected $rows = [
        [
            'id' => 'home',
            'name' => 'New York',
            'icon_src' => '',
            'created_by' => 'xot',
            'updated_by' => 'xot',
        ],
    ];

    // --------- relationship ---------------

    // ---------- mututars -----------
}// end model
