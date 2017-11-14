<?php

namespace App\Policies;

use App\SalesTeam;
use App\Traits\PolicyHelpers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesTeamPolicy
{
    use HandlesAuthorization, PolicyHelpers;


    /**
     * Determine whether the user can list all customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $this->checkAccess($user, ['*', 'team'], ['*','list']);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function view(User $user, SalesTeam $team): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $team->members()->where('user_id', '=', 5)->count() > 0||$team->managers()->where('user_id', '=', 5)->count() > 0 || $this->checkAccess($user, ['*', 'team'], ['*','view']);

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


        return  $this->checkAccess($user, ['*', 'team'], ['*','create']);


    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function update(User $user, SalesTeam $team): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'team'], ['*','edit']);

    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $company
     * @return mixed
     */
    public function delete(User $user, SalesTeam $team): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'team'], ['*','delete']);

    }
}
