<?php

namespace App\Policies;

use App\Traits\PolicyHelpers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization, PolicyHelpers;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(User $user){
        return $this->checkAdmin($user);
    }
    public function view(User $user){
        return $this->checkAdmin($user);
    }
    public function create(User $user){
        return $this->checkAdmin($user);
    }
    public function update(User $user){
        return $this->checkAdmin($user);
    }
    public function delete(User $user){
        return $this->checkAdmin($user);
    }
}
