<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // sesuaikan dengan nama file form kamu
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // arahkan user berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.admin');
            } elseif ($user->role === 'guru') {
                return redirect()->route('pages.guru');
            } elseif ($user->role === 'pembina') {
                return redirect()->route('pages.pembina');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('pages.siswa');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
