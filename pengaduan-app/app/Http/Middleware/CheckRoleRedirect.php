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
        $role = $user->role;

        if ($user->role !== $role) {
            if ($role === 'Admin') {
                return redirect()->route('dashboard.admin');
            } else if ($role === 'Cosutmer Service') {
                return redirect()->route('dashboard.cs');
            } else {
                return redirect()->route('dashboard.user');
            }
        }

        return $next($request);
    }
}