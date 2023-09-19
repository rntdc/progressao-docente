<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyAccount
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->is_verified === 1) {
            return $next($request); // User is verified, proceed to the route
        }

        // User is not verified, redirect or show an error message
        return redirect()->route('verification');
    }
}
