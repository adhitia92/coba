<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Kepalalab
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has the role 'kepalalab'
            if (Auth::user()->role == 'kepalalab') {
                return $next($request);
            }
        }

        // If not authenticated or doesn't have the role, you might want to customize the response
        abort(401, 'Unauthorized. You do not have permission to access this resource.');
    }
}
