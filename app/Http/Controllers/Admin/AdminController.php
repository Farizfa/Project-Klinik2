<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($validate)) {
            Alert::success('Berhasil', 'Login berhasil!');
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); 

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Berhasil', 'Log out berhasil!');

        return redirect()->route('admin.login');
    }
}
