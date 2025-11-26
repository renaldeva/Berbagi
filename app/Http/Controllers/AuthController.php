<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($role === 'user') {
                return redirect('/user/dashboard');
            }

            return abort(403, 'Role tidak dikenal');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Default role = user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', 
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
