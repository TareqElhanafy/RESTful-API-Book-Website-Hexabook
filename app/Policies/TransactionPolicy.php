<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        return $user->id===$transaction->buyer->id || $user->id===$transaction->paidbooks->seller->id;
    }
}
