<?php

namespace App\Policies;

use App\Policy;
use App\Traits\PolicyHelpers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization, PolicyHelpers;

    /**
     * Determine whether the user can list all users.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return boolean
     */
    public function index(User $authenticated_user): bool
    {
        if($this->checkAdmin($authenticated_user)){
            return true;
        }


        return  $this->checkAccess($authenticated_user, ['*', 'user'], ['*','index']);
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $authenticated_user, User $user): bool
    {
        if($this->checkAdmin($authenticated_user)){
            return true;
        }

        return $user->id === $authenticated_user->id || $this->checkAccess($authenticated_user, ['*', 'user'], ['*','view']);
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {

        if($this->checkAdmin($user)){
            return true;
        }


        return  $this->checkAccess($user, ['*', 'user'], ['*','create']);

    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $authenticated_user, User $user)
    {
        if($this->checkAdmin($authenticated_user)){
            return true;
        }


        return $user->id === $authenticated_user->id || $this->checkAccess($authenticated_user, ['*', 'user'], ['*','edit']);
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $authenticated_user)
    {
        if($this->checkAdmin($authenticated_user)){
            return true;
        }


        return $this->checkAccess($authenticated_user, ['*', 'user'], ['*','delete']);

    }


}
