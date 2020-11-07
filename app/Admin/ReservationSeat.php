<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationSeat extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'people',
    ];

    protected $guarded = array('id');


    // relation

    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
