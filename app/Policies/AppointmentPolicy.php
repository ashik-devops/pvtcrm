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
    public function index(User $user): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }

        return $this->checkAccess($user, ['*', 'customer'], ['*','list']);

    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Appointment $appointment): bool
    {

        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'appointment'], ['*','view']);


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

        return $this->checkAccess($user, ['*', 'customer'], ['*','create']);
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Appointment $appointment): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'customer'], ['*','edit']);


    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        if($this->checkAdmin($user)){
            return true;
        }


        return $this->checkAccess($user, ['*', 'customer'], ['*','delete']);
    }


}
