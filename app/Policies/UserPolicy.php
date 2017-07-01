<?php

namespace App\Policies;

use App\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list all users.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $authenticated_user)
    {
        return !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                    ->whereIn('action',['*','list'])->first());
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $authenticated_user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $authenticated_user, User $user)
    {

        return $user->id === $authenticated_user->id || !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','view'])->first()->id);
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !is_null($user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','create'])->first()->id);
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

        return $user->id === $authenticated_user->id || !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','edit'])->first()->id);
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
        return !is_null($authenticated_user->role->policies()->whereIn('scope', ['*', 'user'])
                ->whereIn('action',['*','delete'])->first()->id);
    }


}
