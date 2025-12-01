<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // wajib import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil user
     */
    public function index()
    {
        return view('user.profil.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Form edit profil
     */
    public function edit()
    {
        return view('user.profil.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Proses update profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            // Hapus photo lama jika ada
            if ($user->photo && File::exists(public_path('uploads/profile/' . $user->photo))) {
                File::delete(public_path('uploads/profile/' . $user->photo));
            }

            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $filename);
            $user->photo = $filename;
        }

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'photo' => $user->photo, // pastikan photo tersimpan
        ]);

        return redirect()->route('user.profil.index')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Form ganti password
     */
    public function password()
    {
        return view('user.profil.password'); // pastikan file ini ada: resources/views/user/profil/password.blade.php
    }

    /**
     * Proses ganti password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.profil.index')->with('success', 'Password berhasil diperbarui!');
    }
}
