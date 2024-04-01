<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;

class SingleSessionMiddleware
{
    
    use HttpResponses;
    public function handle($request, Closure $next)
    {       
        $credentials = $request->only('email', 'password');
          
        if(!Auth::attempt($credentials, false)) {
            return $this->error('', 'Credentials do not match', 401);
        }
       
        if (Auth::check()) {
            $userId = Auth::id();
        
            $sessionKey = 'user_session_' . $userId;
            // Check if the user has an active session elsewhere
            
            if ($activeSession = cache($sessionKey)) {
                //remove sanctum tokens
                DB::table('personal_access_tokens')->where('tokenable_id', $userId)->delete();
                // Clear the previous session cache
                cache()->forget($sessionKey);
            }
           
            // Store the current session in cache
            cache([$sessionKey => true], now()->addMinutes(15));
        }
        return $next($request);
    }
}
