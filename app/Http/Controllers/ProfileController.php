<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Halaman profil utama (menampilkan data user).
     */
    public function index()
    {
        return view('user.profil.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Halaman edit profil.
     */
    public function edit()
    {
        return view('user.profil.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Proses update profil.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();

        // Cek jika email berubah & sudah dipakai user lain
        if ($request->email !== $user->email) {
            $request->validate([
                'email' => 'unique:users,email'
            ]);
        }

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.profil.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Halaman reset / ubah password.
     */
    public function passwordPage()
    {
        return view('user.profil.password');
    }

    /**
     * Proses update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama salah.',
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.profil.index')
            ->with('success', 'Password berhasil diubah!');
    }
}
