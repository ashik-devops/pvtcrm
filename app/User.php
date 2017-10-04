<?php

namespace App;

use App\Jobs\SendResetPasswordNotification;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, DispatchesJobs, Notifiable, SoftDeletes, CausesActivity, LogsActivity{
    LogsActivity::activity insteadof CausesActivity;
    CausesActivity::activity as log;
}

    protected static $logAttributes = ['first_name', 'last_name', 'password', 'email', 'profile'];
    protected static $logOnlyDirty = true;

    public $obj_alias = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() : HasOne
    {
        return $this->hasOne('App\User_profile');
    }
    public function role() : BelongsTo
    {
        return $this->belongsTo('App\Role');
    }

    public function customers(): HasMany
    {
        return $this->hasMany('App\Customer');
    }

    public function isAdmin() : bool
    {
        return !is_null($this->role->policies()
        ->whereHas('action',function($query){
            $query->where('name', '=', '*');
        })->whereHas('scope',function($query){
            $query->where('name', '=', '*');
            })->first());
    }
    public function isSuperAdmin() : bool
    {
        return $this->role->id==1 && !is_null($this->role->policies()
                ->whereHas('action',function($query){
                    $query->where('name', '=', '*');
                })->whereHas('scope',function($query){
                    $query->where('name', '=', '*');
                })->first());
    }

    public function salesTeams() : BelongsToMany
    {
        return $this->belongsToMany('App\Sales_team', 'sales_teams_users');
    }
    public function getLink(): string
    {
        if($this->id > 0){
            return route('profile-edit', $this->id);
        }

        return '#';
    }

    public function getActivityTitle(): string
    {
        if($this->id > 0){
            return $this->name;
        }

        return "";
    }

    public function timezone() : Timezone
    {
        return $this->profile->timezone;
    }

    public function getSubordinates(): array
    {
        return [];
    }

    public function getNameAttribute(): string
    {
        return implode(', ', array_filter([$this->last_name, $this->first_name]));
    }

    /**
     * Sends the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->dispatch(new SendResetPasswordNotification($this, (new ResetPassword($token, $this))));

    }
}
