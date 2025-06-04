<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role = ''): Response
    {
        $user = $request->user();

        // Jika tidak login atau tidak memiliki peran yang diizinkan
        if (!$user || !$user->hasPeran($role)) {
            return response()->view('error.403', [], 403);
        }

        return $next($request);
    }
}
