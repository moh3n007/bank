<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admins
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
        $user = Auth::user();
        if($user->role != 'admin') {
            Auth::logout();
            return redirect(route('login'))->with('alert.error', 'کاربر غیرمجاز');
        }
        return $next($request);
    }
}
