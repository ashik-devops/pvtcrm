<?php

namespace App\Policies;

use App\User;
use App\Customer;
use App\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list all customers.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {

        return !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                    ->whereIn('action',['*','list'])->first()->id);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return $user->id === $customer->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                    ->whereIn('action',['*','view'])->first()->id);

    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return  !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                    ->whereIn('action',['*','create'])->first()->id);
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                    ->whereIn('action',['*','edit'])->first()->id);
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return $user->id === $customer->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                    ->whereIn('action',['*','delete'])->first()->id);
    }
}
