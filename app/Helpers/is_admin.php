<?php

use App\Models\Role;
use App\Models\User;

if (!function_exists('is_admin')) {
    function is_admin(User $user): bool
    {
        $adminRole = Role::admin()->first();

        return $user->role_id === $adminRole->id;
    }
}
