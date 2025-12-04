<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Otp;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'user') {
                return redirect()->route('user.dashboard');
            }

            return abort(403, 'Role tidak dikenal');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|digits:6',
        ]);

        // Cek OTP di database
        $otp = Otp::where('email', $request->email)
                ->where('code', $request->otp)
                ->where('used', false)
                ->where('expires_at', '>', now())
                ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'OTP tidak valid atau sudah kadaluarsa'])->withInput();
        }

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        // Tandai OTP sudah dipakai
        $otp->used = true;
        $otp->save();

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Kirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $otpCode = rand(100000, 999999);

            // Simpan OTP di database
            Otp::create([
                'email' => $request->email,
                'code' => $otpCode,
                'expires_at' => now()->addMinutes(2),
                'used' => false,
            ]);

            // Kirim email OTP
            Mail::to($request->email)->send(new \App\Mail\OtpMail($otpCode));

            return response()->json([
                'success' => true,
                'message' => 'OTP berhasil dikirim ke email Anda'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP: ' . $e->getMessage()
            ]);
        }
    }
}
