<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, $iddicari)
    {
        return $user->id_user == $iddicari->id_user;
    }
}
