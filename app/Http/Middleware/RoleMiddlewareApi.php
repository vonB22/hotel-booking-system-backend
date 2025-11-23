<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddlewareApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if ($request->user() === null) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'error' => 'You must be logged in to access this resource',
            ], 401);
        }

        // Check if user has one of the required roles
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // User doesn't have any of the required roles
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
            'error' => 'You do not have permission to access this resource. Required role(s): ' . implode(', ', $roles),
            'user_roles' => $request->user()->roles->pluck('name')->toArray(),
            'required_roles' => $roles,
        ], 403);
    }
}
