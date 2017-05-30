<?php

namespace App\Providers;

use App\Customer;
use App\Policies\CustomerPolicy;
use App\Policies\UserPolicy;
use App\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Customer::class => CustomerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('user', UserPolicy::class, [
            'list'=>UserPolicy::class.'@list'
        ]);
        Gate::resource('customer', CustomerPolicy::class, [
            'list'=>CustomerPolicy::class.'@list'
        ]);
    }
}
