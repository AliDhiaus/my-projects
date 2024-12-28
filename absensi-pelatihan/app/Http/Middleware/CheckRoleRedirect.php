<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user->role !== $role) {
            if ($user->role == 'admin') {
                return redirect()->route('dashboard.admin');
            }
            return redirect()->route('dashboard.user');
        }

        return $next($request);
    }
}