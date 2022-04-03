<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $record)
    {
        return $user->id === $record->id;
    }

    public function update(User $user, User $record)
    {
        return $user->id === $record->id;
    }
}
