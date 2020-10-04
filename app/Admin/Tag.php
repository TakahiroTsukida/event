<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getHashtagAttribute(): string
    {
        return '#'.$this->name;
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany('App\Admin\Event')->withTimestamps();
    }
}
