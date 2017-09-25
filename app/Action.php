<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model
{
    protected $fillable = ['name', 'label'];

    public function policies():HasMany{
        return $this->hasMany('App\Policy');
    }
}
