<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use App\UserSession;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();
        
        $atribytes['session_id'] = Session::getId();
        $atribytes['user_ip'] = $request->ip();
        $atribytes['browser'] = $agent->browser();
        
        if(UserSession::where('session_id', $atribytes['session_id'])->count() == 0)
        {
            UserSession::add($atribytes);
        }
        
        return $next($request);
    }
}
