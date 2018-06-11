<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function add($attributes)
    {
        $user = new static;
        $user->fill($attributes);
        $user->password = bcrypt($attributes['password']);
        $user->save();
    }
}
