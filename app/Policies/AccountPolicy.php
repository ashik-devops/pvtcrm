<?php

namespace App\Policies;

use App\Account;
use App\Traits\PolicyHelpers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization, PolicyHelpers;

    /**
     * Determine whether the user can list all customers.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $this->checkAccess($user, ['*', 'account'], ['*','list']);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function view(User $user, Account $company): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $user->id === $company->user->id || $this->checkAccess($user, ['*', 'account'], ['*','view']);

    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return  $this->checkAccess($user, ['*', 'account'], ['*','create']);


    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function update(User $user, Account $company): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $user->id === $company->user->id || $this->checkAccess($user, ['*', 'account'], ['*','edit']);

    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function delete(User $user, Account $company): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $user->id === $company->user->id || $this->checkAccess($user, ['*', 'account'], ['*','delete']);

    }
}
