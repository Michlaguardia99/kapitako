<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user's email is verified
            if (!Auth::user()->hasVerifiedEmail()) {
                // Redirect the user to a page informing them to verify their email
                return redirect()->route('verification.notice');
            }
        }

        // If the user is authenticated and verified, or if the user is a guest, proceed to the next middleware or route handler
        return next($request);
    }
}
