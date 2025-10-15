<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // halaman login kamu
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('nama', $request->username)->first();

        if (!$user || $request->password !== $user->password) {
            return back()->withErrors(['login' => 'Username atau password salah']);
        }


        Auth::login($user);

        // Arahkan sesuai role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'guru':
                return redirect()->route('pages.guru');
            case 'pembina':
                return redirect()->route('pages.pembina');
            case 'siswa':
            case 'ortu':
                return redirect()->route('pages.siswa');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['login' => 'Role tidak dikenali.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
