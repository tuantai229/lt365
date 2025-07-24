<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user is active and email is verified
            if (!$user->isVerified() || !$user->isActive()) {
                Auth::logout();
                
                return redirect()->route('auth.login')
                    ->withErrors(['email' => 'Tài khoản chưa được xác thực email hoặc chưa được kích hoạt.']);
            }
        }

        return $next($request);
    }
}
