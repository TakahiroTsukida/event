<?php

namespace App;

use App\Mail\User\BareMail;
use App\Notifications\User\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'birthday', 'introduction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public static $rules = array(
        'name' => ['required', 'string', 'max:255'],
        'gender' => ['required'],
        'birthday' => ['required', 'before:now'],
        'introduction' => ['nullable', 'string', 'max:255'],
        'image' => ['nullable', 'image', 'max:2048'],
    );



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }


    public function joins(): BelongsToMany
    {
        return $this->belongsToMany('App\Admin\Event', 'joins')->withTimestamps();
    }


}
