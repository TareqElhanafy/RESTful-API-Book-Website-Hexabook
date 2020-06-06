<?php

namespace App\Policies;

use App\User;
use App\Paidbook;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaidbookPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Paidbook $paidbook)
    {
        return $user->id===$paidbook->seller->id;
    }
     /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(User $user, Paidbook $paidbook)
    {
        return $user->id===$paidbook->seller->id;

    }
}
