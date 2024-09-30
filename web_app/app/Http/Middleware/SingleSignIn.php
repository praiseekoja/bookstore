<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SingleSignIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('user')){
            $userId = session('user');
            $deviceId = session('deviceId');

            $user = User::where('auth.userId', $userId)
            ->first();

            if($deviceId != $user->deviceId){
                Auth::logout();
                $request->session()->forget('user');
            }
        }
        return $next($request);
    }
}
