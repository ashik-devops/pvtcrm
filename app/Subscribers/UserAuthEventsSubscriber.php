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
            ->log('<a href="'.$event->user->getLink().'">'.$event->user->getActivityTitle(). '</a> has logged in.', 'login');
    }

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onUserLogout($event) {
        app(ActivityLogger::class)
            ->causedBy($event->user)
            ->log('<a href="'.$event->user->getLink().'">'.$event->user->getActivityTitle(). '</a> has logged out.', 'logout');
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
    }
}