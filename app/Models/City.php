<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $guarded = array('id');

    //リレーション
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo('App\Models\Prefecture');
    }
}
