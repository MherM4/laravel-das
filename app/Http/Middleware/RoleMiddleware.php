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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = auth()->user()->role;

        if ($userRole === 'super_admin') {
            return $next($request);
        }

        if ($userRole !== $role) {
            abort(403, 'Այս գործողությունը թույլատրված չէ։');
        }

        return $next($request);
    }
}
