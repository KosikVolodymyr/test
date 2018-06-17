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
        
        $attributes['session_id'] = Session::getId();
        $attributes['user_ip'] = $request->ip();
        $attributes['browser'] = $agent->browser();
        
        if (UserSession::where('session_id', $attributes['session_id'])->count() == 0) {
            $session = new UserSession();
            $session->fill($attributes);
            $session->save();
        }
        
        return $next($request);
    }
}
