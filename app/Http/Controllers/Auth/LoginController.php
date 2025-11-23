<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        // 1. Ubah validasi agar TIDAK memaksa format email
        // Ganti 'email' jadi 'login' agar fleksibel
        $request->validate([
            'login'    => 'required', // Bisa diisi Username atau Email
            'password' => 'required',
        ]);

        // 2. Cek apakah inputan user itu Email atau Username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Gabungkan jadi kredensial
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        // 4. Proses Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 5. Redirect Berdasarkan Role
            // Pastikan nama route ini SESUAI dengan web.php
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.admin');
                case 'guru':
                    return redirect()->route('pages.guru');
                case 'pembina':
                    return redirect()->route('pages.pembina');
                case 'siswa':
                    return redirect()->route('pages.siswa');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role akun tidak valid.');
            }
        }

        // 6. Jika Gagal
        return back()->withErrors([
            'login' => 'Username/Email atau password salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
