<?php

namespace App\Policies;

use App\Account;
use App\Traits\AdminPolicies;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Customer_CompanyPolicy
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
        return !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
            ->whereIn('action',['*','list'])->first()->id);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function view(User $user, Account $company)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return $user->id === $company->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
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
        if($this->checkAdmin($user)){
            return true;
        }
        return  !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
            ->whereIn('action',['*','create'])->first()->id);
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function update(User $user, Account $company)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return $user->id === $company->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                ->whereIn('action',['*','edit'])->first()->id);
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function delete(User $user, Account $company)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return $user->id === $company->user->id || !is_null($user->policies()->whereIn('scope', ['*', 'customer'])
                ->whereIn('action',['*','delete'])->first()->id);
    }
}
