<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->active == 1 && Auth::guard('admin')->user()->role == 'admin')
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect('/admin/login')->with('error', 'غير مصرح بالدخول');
        }
    }
}
