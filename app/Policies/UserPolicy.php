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
    public function index(User $authenticated_user) : bool
    {
        if($this->checkAdmin($authenticated_user)){
            return true;
        }
        return !is_null($authenticated_user->role->policies()
            ->whereHas('action',function($query){
                $query->whereIn('name', ['*', 'index']);
            })
            ->whereHas('scope',function($query){
                $query->whereIn('name', ['*', 'user']);
            })->first());
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $authenticated_user, User $user) : bool
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
    public function create(User $user)
    {

        if($this->checkAdmin($user)){
            return true;
        }
        return !is_null($user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','create'])->first());
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

        return $user->id === $authenticated_user->id || !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','edit'])->first());
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

        return !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','delete'])->first());
    }


}
