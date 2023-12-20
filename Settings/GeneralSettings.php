<?php

declare(strict_types=1);

namespace Modules\Ticket\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public bool $enable_registration;

    public string|null $site_logo = null;

    public string|null $enable_social_login = null;

    public string|null $site_language = null;

    public string|null $default_role = null;

    public string|null $enable_login_form = null;

    public string|null $enable_oidc_login = null;

    public static function group(): string
    {
        return 'general';
    }
}
