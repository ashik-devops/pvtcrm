<?php

namespace App\Providers;

use App\Appointment;
use App\Customer;
use App\Account;
use App\Policies\AppointmentPolicy;
use App\Policies\AccountPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use App\Task;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Customer::class => CustomerPolicy::class,
        Task::class=>TaskPolicy::class,
        Appointment::class=>AppointmentPolicy::class,
        Account::class=>AccountPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));


        Gate::resource('user', UserPolicy::class, [
            'index'=>UserPolicy::class.'@index'
        ]);
        Gate::resource('customer', CustomerPolicy::class, [
            'index'=>CustomerPolicy::class.'@index'
        ]);
        Gate::resource('task', TaskPolicy::class, [
            'index'=>TaskPolicy::class.'@index'
        ]);
        Gate::resource('appointment', AppointmentPolicy::class, [
            'index'=>CustomerPolicy::class.'@index'
        ]);
        Gate::resource('customer_company', AccountPolicy::class, [
            'index'=>CustomerPolicy::class.'@index'
        ]);
    }
}
