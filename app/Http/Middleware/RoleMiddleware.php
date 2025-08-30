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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();

        // Jika rolenya cocok, teruskan request
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika role adalah 'staff', redirect ke dashboard.staff
        if ($user->role === 'staff') {
            return redirect()->route('onlystaff');
        }

        // Jika tidak ada yang cocok, abort
        abort(403);
    }
}
