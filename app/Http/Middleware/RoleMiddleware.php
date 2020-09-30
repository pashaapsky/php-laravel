<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if (auth()->user()) {
            if (!auth()->user()->hasRole($role)) {
                abort(403, 'THIS ACTION IS UNAUTHORIZED.');
            }

            if ($permission !== null && !auth()->user()->hasPermissionTo($permission)) {
                abort(403, 'THIS ACTION IS UNAUTHORIZED.');
            }
        } else {
            return redirect('/');
        }

        return $next($request);
    }
}
