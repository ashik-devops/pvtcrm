<?php
/**
 * Created by PhpStorm.
 * User: rode
 * Date: 10/5/17
 * Time: 2:07 PM
 */

namespace App\Helpers;


use Spatie\Activitylog\ActivityLogger as BaseActivityLogger;
use Spatie\Activitylog\ActivitylogServiceProvider;

class ActivityLogger extends  BaseActivityLogger
{
    /**
     * @param string $description
     *
     * @return null|mixed
     */
    public function log(string $description, $eventname=null)
    {
        if (! $this->logEnabled) {
            return;
        }

        $activity = ActivitylogServiceProvider::getActivityModelInstance();

        if ($this->performedOn) {
            $activity->subject()->associate($this->performedOn);
        }

        if ($this->causedBy) {
            $activity->causer()->associate($this->causedBy);
        }
        $activity->type=$eventname;
        $activity->properties = $this->properties;

        $activity->description = $this->replacePlaceholders($description, $activity);

        $activity->log_name = $this->logName;

        $activity->save();

        return $activity;
    }

}