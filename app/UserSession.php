<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $fillable = ['session_id', 'user_ip', 'browser'];
    
    public static function getBrowsersCount()
    {
        return \DB::table('user_sessions')
            ->select('browser as name', \DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->orderBy('browser')
            ->get();
    }
}
