<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi'
        ];

        $credentials = $request->validate($rules, $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            activity()
                ->causedBy(Auth::user())
                ->withProperties(['ip' => $request->ip()])
                ->log('Login');

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email / Password Salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        activity()
            ->causedBy(Auth::user())
            ->withProperties(['ip' => $request->ip()])
            ->log('Logout');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
