<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prefecture extends Model
{
    protected $guarded = array('id');

    //リレーション
    public function cities(): HasMany
    {
        return $this->hasMany('App\Models\City');
    }
}
