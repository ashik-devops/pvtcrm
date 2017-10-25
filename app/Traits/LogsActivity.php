<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Traits\DetectsChanges;

trait LogsActivity
{
    use DetectsChanges;

    protected $enableLoggingModelsEvents = true;

    protected static function bootLogsActivity()
    {
        static::eventsToBeRecorded()->each(function ($eventName) {
            return static::$eventName(function (Model $model) use ($eventName) {
                if (! $model->shouldLogEvent($eventName)) {
                    return;
                }

                $description = $model->getDescriptionForEvent($eventName);

                $logName = $model->getLogNameToUse($eventName);

                $attributes = $model->attributeValuesToBeLogged($eventName);
                if($eventName == 'updated' && !empty($attributes)){
                    return;
                }

                    if ($description == '') {
                    return;
                }

                app(ActivityLogger::class)
                    ->useLog($logName)
                    ->performedOn($model)
                    ->withProperties()
                    ->log($description, $eventName);
            });
        });
    }

    public function disableLogging()
    {
        $this->enableLoggingModelsEvents = false;

        return $this;
    }

    public function enableLogging()
    {
        $this->enableLoggingModelsEvents = true;

        return $this;
    }

    public function activity(): MorphMany
    {
        return $this->morphMany(ActivitylogServiceProvider::determineActivityModel(), 'subject');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $user=Auth::user();
        if (is_null(Auth::user())) {
            return "<strong><a href='#'> System</a></strong> has {$eventName} {$this->obj_alias}: <a href='".$this->getLink()."'>".$this->getActivityTitle()."</a>";
        }

        return'<strong><a href="' . route('profile-view', [$user->id]) . '">' . $user->name . '</a><strong> has ' .$eventName . ' ' . $this->obj_alias . ': <a href="' . $this->getLink() . '">' . $this->getActivityTitle() . '</a>';

    }

    public function getLogNameToUse(string $eventName = ''): string
    {
        return config('activitylog.default_log_name');
    }

    /*
     * Get the event names that should be recorded.
     */
    protected static function eventsToBeRecorded(): Collection
    {
        if (isset(static::$recordEvents)) {
            return collect(static::$recordEvents);
        }

        $events = collect([
            'created',
            'updated',
            'deleted',
        ]);

        if (collect(class_uses_recursive(__CLASS__))->contains(SoftDeletes::class)) {
            $events->push('restored');
        }

        return $events;
    }

    public function attributesToBeIgnored(): array
    {
        if (! isset(static::$ignoreChangedAttributes)) {
            return [];
        }

        return static::$ignoreChangedAttributes;
    }

    protected function shouldLogEvent(string $eventName): bool
    {
        if (! $this->enableLoggingModelsEvents) {
            return false;
        }

        if (! in_array($eventName, ['created', 'updated'])) {
            return true;
        }

        if (array_has($this->getDirty(), 'deleted_at')) {
            if ($this->getDirty()['deleted_at'] === null) {
                return false;
            }
        }

        //do not log update event if only ignored attributes are changed
        return (bool) count(array_except($this->getDirty(), $this->attributesToBeIgnored()));
    }

}
