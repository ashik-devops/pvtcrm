<?php

namespace App\Policies;

use App\Appointment;
use App\Traits\PolicyHelpers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\App;

class AppointmentPolicy
{
    use HandlesAuthorization, PolicyHelpers;

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
        return !is_null($user->role->policies()
            ->whereIn('scope',['customer','*'])
            ->whereIn('action',['*','list'])->first());
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Appointment $appointment)
    {

        if($this->checkAdmin($user)){
            return true;
        }

        return !is_null($user->role->policies()
            ->whereIn('scope',  ['appointment','*'])
            ->whereIn('action',['view','*'])->first());

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
        return  !is_null($user->role->policies()->whereIn('scope',['customer','*'])
            ->whereIn('action',['*','create'])->first());
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Appointment $appointment)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return !is_null($user->role->policies()->whereIn('scope',['customer','*'])
                ->whereIn('action',['*','edit'])->first());
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Appointment $appointment)
    {
        if($this->checkAdmin($user)){
            return true;
        }
        return !is_null($user->role->policies()->whereIn('scope',['customer','*'])
                ->whereIn('action',['*','delete'])->first()->id);
    }


}
