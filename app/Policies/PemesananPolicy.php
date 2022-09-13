<?php

namespace App\Policies;

use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemesananPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pemesanan $pemesanan)
    {
        return $user->id_user == $pemesanan->id_user;
    }
}
