<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('login');
        }
        $user = Auth::guard('admin')->user();
        if($user){
            return $next($request);
        }
        // if($user->level == $roles)
            // return $next($request);

        return redirect('login')->with(['error', 'You don`t have any access on this route.']);
    }
}
