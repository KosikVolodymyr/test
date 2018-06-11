<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }
    
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150||username',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|max:20'
        ]);
        
        $user = User::add($request->all());
        
        return redirect()->route('loginForm');
    }
    
    public function loginForm()
    {
        return view('pages.login');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $auth = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
                
        if($auth)
        {
           return redirect('/'); 
        }
        
        return redirect()->back()->with('status', 'Incorrect login or password');
    }
    
    public function logout() {
        Auth::logout();
        
        return redirect('/');
    }
}
