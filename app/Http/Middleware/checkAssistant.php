<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkAssistant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has the 'assistant' role
        if (Auth::check() && Auth::user()->userRole === 'assistant') {
            return $next($request);
        }

        // If the user doesn't have the 'adaa' role, redirect them to the sign page with an error message
        return redirect()->route('signin')->with('error', 'Access denied. You do not have permission to access this page.');
    }
}
