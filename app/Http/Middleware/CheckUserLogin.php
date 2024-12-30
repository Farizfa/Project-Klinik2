<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if ($userType == 'admin') {
            $user = Auth::guard('admin')->user(); 
            if (!$user) {
                return redirect()->route('admin.login');
            }
        } elseif ($userType == 'dokter') {
            $user = Auth::guard('dokter')->user();
            if (!$user) {
                return redirect()->route('dokter.login'); 
            }
        } elseif ($userType == 'pasien') {
            $user = Auth::guard('pasien')->user();
            if (!$user) {
                return redirect()->route('pasien.login');
            }
        }

        return $next($request);
    }
}
