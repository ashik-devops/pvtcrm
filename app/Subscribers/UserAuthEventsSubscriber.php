<?php

namespace App\Subscribers;


use App\Helpers\ActivityLogger;

class UserAuthEventsSubscriber
{
    /**
     * Handle user login events.
     * @param $event
     */
    public function onUserLogin($event) {
        app(ActivityLogger::class)
            ->causedBy($event->user)
            ->log('<strong><a href="'.$event->user->getLink().'">'.$event->user->getActivityTitle(). '</a> has logged in.</strong>', 'login');
    }

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onUserLogout($event) {
        app(ActivityLogger::class)
            ->causedBy($event->user)
            ->log('<strong></strong><a href="'.$event->user->getLink().'">'.$event->user->getActivityTitle(). '</a> has logged out.</strong>', 'logout');
    }

    /**
     * @param $event
     */
    public function onUserLoginFailed($event){
        app(ActivityLogger::class)
            ->causedBy($event->user)
            ->log('<strong>Attempt to log in as user: <a href="'.$event->user->getLink().'">'.$event->user->getActivityTitle(). '</a> has failed.</strong>strong>', 'logout');

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Subscribers\UserAuthEventsSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Subscribers\UserAuthEventsSubscriber@onUserLogout'
        );

        $events->listen(
            'Illuminate\Auth\Events\Failed',
            'App\Subscribers\UserAuthEventsSubscriber@onUserLoginFailed'
        );
    }
}