<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (! $request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $allowedRoles = collect($roles)->map(fn (string $role) => Role::from($role));

        if (! $allowedRoles->contains($request->user()->role)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
