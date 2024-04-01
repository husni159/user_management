<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

class AdminMiddleware
{    
    use HttpResponses;
    public function handle($request, Closure $next)
    {
        
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has the admin role (role = 1)
            if (Auth::user()->role == 1) {
                return $next($request);
            }
        }
        
        // If the user is not authenticated or does not have the admin role, redirect or respond accordingly
        return $this->error(
            [],
            'Unauthorized Access',
             301
        );
    }
}
