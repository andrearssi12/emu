<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $messages = [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi'
        ];

        $request->validate($rules, $messages);

        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if (empty($user)) {
            $error = 'Username / Password Salah';
            return redirect('/')
                ->withInput()
                ->withErrors(['errors' => $error]);
        }

        if (!Hash::check($password, $user->password)) {
            $error = 'Username / Password Salah';
            return redirect('/')->withErrors(['errors' => $error]);
        }

        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('succes', 'Anda berhasil login');
        } else {
            $error = 'Gagal melakukan otentikasi';
            return redirect('/')->withErrors(['errors' => $error]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
