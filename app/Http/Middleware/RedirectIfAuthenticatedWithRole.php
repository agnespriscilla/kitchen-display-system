<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedWithRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            return redirect(match ($user->role) {
                'superadmin' => route('superadmin'),
                'admin' => route('admin'),
                'user' => route('user'),
                default => '/',
            });
        }

        return $next($request);
    }
}
