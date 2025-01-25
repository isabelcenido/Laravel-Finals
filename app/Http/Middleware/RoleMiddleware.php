<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {

        $user = Auth::user();
        if ($user && $user->role === $role) {
            return $next($request);
        }

        // If the user doesn't have the right role, redirect somewhere (e.g., login page)
        return redirect()->route('login')->withErrors(['role' => 'You do not have access to this page.']);
    }
}
