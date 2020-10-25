<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'begin',
        'end',
        'descripsion',
    ];

    protected $guarded = array('id');

    // relation

    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
