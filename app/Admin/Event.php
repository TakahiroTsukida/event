<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\User;
use Storage;
// use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    public const EVENT_HELD = [
        'オンライン' => 200,
    ];

    protected $fillable = [
        'name',
        'shop_id',
        'title',
        'start_time',
        'end_time',
        'deadline',
        'descripsion',
        'conditions',
        'image_path',
    ];

    protected $guarded = array('id');


    // relation

    public function shop(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Shop');
    }

    public function reservation_seats(): HasMany
    {
        return $this->hasMany('App\Admin\ReservationSeat');
    }

    public function prices(): HasMany
    {
        return $this->hasMany('App\Admin\Price');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany('App\Admin\Schedule');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function joins(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'joins')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Admin\Tag')->withTimestamps();
    }


    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }


    public function isJoinedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->joins->where('id', $user->id)->count()
            : false;
    }
}
