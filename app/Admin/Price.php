<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $fillable = [
        'event_id',
        'gender',
        'status',
        'price',
        'notes',
    ];

    protected $guarded = array('id');

    // relation

    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
