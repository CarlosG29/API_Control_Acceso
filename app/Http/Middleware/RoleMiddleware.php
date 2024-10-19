<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Verifica si el usuario está autenticado y tiene el rol adecuado
    if (!auth()->check() || auth()->user()->role !== $role) {
        return response()->json(['message' => 'No autorizado'], 403);
    }

    return $next($request);
}

}
