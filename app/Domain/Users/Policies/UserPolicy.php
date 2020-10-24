<?php

namespace App\Domain\Users\Policies;

use App\Domain\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function uploadFiles(User $user)
    {
        logger($user);
        return true;
    }
}
