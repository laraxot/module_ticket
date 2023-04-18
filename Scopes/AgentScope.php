<?php

declare(strict_types=1);

namespace Modules\Ticket\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class AgentScope implements Scope {
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model) {
        $user = Auth::user();
        if (null == $user) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
        if (auth()->check() && request()->is('admin/*') && $user->hasRole('2') /* && $user->roles->contains(2) */) {
            $builder->where('assigned_to_user_id', $user->id);
        }
    }
}
