<?php

namespace App\Policies;

use App\Domain\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function uploadFiles(User $user)
    {
        return true;
    }
}
