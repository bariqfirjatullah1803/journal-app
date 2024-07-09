<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function formLogin(): View|RedirectResponse
    {
        if (Auth::check()) return to_route('journal.index');
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);
        # JIKA BERHASIL LOGIN
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return to_route('journal.index');
        }

        # JIKA GAGAL LOGIN
        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function register(Request $request)
    {

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        return to_route('login');
    }
}
