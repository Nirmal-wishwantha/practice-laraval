<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized. Please log in.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (Auth::user()->role_id !== 1 && Auth::user()->role_id !== 2) {
            return response()->json([
                'message' => 'Forbidden. Only admins can access this route.'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
