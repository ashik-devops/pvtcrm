<?php

namespace App\Policies;

use App\User;
use App\UserGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $this->checkAccess($user, ['*', 'group'], ['*','list']);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function view(User $user, UserGroup $group): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $group->members()->where('user_id', '=', 5)->count() > 0||$group->managers()->where('user_id', '=', 5)->count() > 0 || $this->checkAccess($user, ['*', 'team'], ['*','view']);

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


        return  $this->checkAccess($user, ['*', 'group'], ['*','create']);


    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function update(User $user, UserGroup $group): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'group'], ['*','edit']);

    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function delete(User $user, UserGroup $group): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'group'], ['*','delete']);

    }
}
