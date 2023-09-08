<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$type): Response
    {
         // Check if the user is authenticated
         if (Auth::check()) {
            $user = Auth::user();
            // Check the user's type and handle the logic accordingly
            if ($user->type === $type) {
                // Continue with the request
                return $next($request);
            }
        }

        // If not authenticated or user type does not match, handle the response
        abort(403, 'Unauthorized');

    }
}
