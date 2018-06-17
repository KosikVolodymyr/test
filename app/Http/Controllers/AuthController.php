<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\AuthLogin;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }
    
    public function register(AuthRegister $request)
    {
        User::add($request->all());
        
        return redirect()->route('loginForm');
    }
    
    public function loginForm()
    {
        return view('pages.login');
    }
    
    public function login(AuthLogin $request)
    {
        $auth = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
                
        if ($auth) {
           return redirect('/'); 
        }
        
        return redirect()->back()->with('status', 'Incorrect login or password');
    }
    
    public function logout()
    {
        Auth::logout();
        
        return redirect('/');
    }
}
