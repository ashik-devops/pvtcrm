<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    protected static $logAttributes = ['name', 'policies'];
    protected static $logOnlyDirty = true;


    public $obj_alias = 'Role';

    public function users() : HasMany{
        return $this->hasMany('App\User');
    }


    public function policies() : BelongsToMany{
        return $this->belongsToMany('App\Policy', 'roles_policies', 'role_id', 'policy_id');
    }

    public function getLink(): string {
        return '#';
    }

    public function getActivityTitle(): string{

        if($this->id > 0){
            return $this->name;
        }
        return '';
    }

    public function attributeValuesToBeLogged(string $processingEvent): array
    {
        if (!count($this->attributesToBeLogged())) {
            return [];
        }

        $properties['attributes'] = static::logChanges(
            $this->exists
                ? $this->fresh() ?? $this
                : $this
        );

        if (static::eventsToBeRecorded()->contains('updated') && $processingEvent == 'updated') {
            $nullProperties = array_fill_keys(array_keys($properties['attributes']), null);

            $properties['old'] = array_merge($nullProperties, $this->oldAttributes);
        }

        if ($this->shouldlogOnlyDirty() && isset($properties['old'])) {
            $properties['attributes'] = array_udiff_assoc(
                $properties['attributes'],
                $properties['old'],
                function ($new, $old) {
                    return $new <=> $old;
                }
            );
            $properties['old'] = collect($properties['old'])
                ->only(array_keys($properties['attributes']))
                ->all();
        }

        return $properties;
    }



}
