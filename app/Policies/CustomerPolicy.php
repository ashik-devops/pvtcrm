<?php

namespace App\Policies;

use App\Traits\AdminPolicies;
use App\User;
use App\Customer;
use App\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization, AdminPolicies;

    /**
     * Determine whether the user can list all customers.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {

        if($this->checkAdmin($user)){
            return true;
        }

        return !is_null($user->role->policies()->whereIn('scope', ['customer', '*'])
            ->whereIn('action',['*','list'])->first());
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
        if($this->checkAdmin($user)){
        return true;
        }
        return $user->id === $customer->user->id || !is_null($user->role->olicies()->where('scope', ['customer', '*'])
                ->whereIn('action',['*','list'])->first());

    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return  !is_null($user->role->policies()->where('scope', ['customer', '*'])
            ->whereIn('action',['*','create'])->first());
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
        if($this->checkAdmin($user)){
            return true;
        }
        return $user->id === $customer->user->id || !is_null($user->role->policies()->where('scope', ['customer', '*'])
                ->whereIn('action',['*','edit'])->first());
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
        if($this->checkAdmin($user)){
            return true;
        }
        return $user->id === $customer->user->id || !is_null($user->role->policies()->where('scope', ['customer', '*'])
                ->whereIn('action',['*','delete'])->first());
    }
}
