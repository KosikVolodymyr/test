<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\AuthLogin;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function registerForm()
    {
        return view('pages.register');
    }
    
    public function register(AuthRegister $request)
    {
        $this->authService->create($request);
        
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
