<?php

namespace App\Services;

use App\User;
use App\Http\Requests\AuthRegister;

class AuthService
{
    public function create(AuthRegister $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->get('password'));
        $user->save();
        
        return $user;
    }
}
