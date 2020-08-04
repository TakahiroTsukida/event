<?php

namespace App\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'login_id', 'name', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $guarded = array('id');


    public static function register($request, $admin)
    {
        $admin->fill($request->all());
        $admin->password = Hash::make($request->password);
        $admin->save();
    }
}
