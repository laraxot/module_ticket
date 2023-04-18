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

/**
 * Modules\Ticket\Models\Profile
 *
 * @property int $id
 * @property string|null $post_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $user_id
 * @property string|null $bio
 * @property string|null $emails
 * @property string|null $mobiles
 * @property string|null $envelope_id
 * @property int|null $is_signed
 * @property int $company_selected_id
 * @property string $company_data_requests
 * @property string|null $nexi_transaction_code
 * @property-read string|null $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Modules\LU\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCompanyDataRequests($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCompanySelectedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEnvelopeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereIsSigned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMobiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNexiTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Role> $roles
 * @mixin \Eloquent
 */
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
