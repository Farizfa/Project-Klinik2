<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!Auth::guard('admin')->check() && !Auth::guard('dokter')->check() && !Auth::guard('pasien')->check()) {
            // Jika tidak ada user yang terautentikasi, arahkan ke login masing-masing guard
            if ($request->expectsJson()) {
                return null;
            }

            // Arahkan ke login berdasarkan guard yang tepat
            if ($request->is('admin/*')) {
                return route('admin.login');
            } elseif ($request->is('dokter/*')) {
                return route('dokter.login');
            } elseif ($request->is('pasien/*')) {
                return route('pasien.login');
            }

            // Default jika tidak cocok, arahkan ke login umum
            return route('pasien.login');
        }

        return null;
    }
}
