<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // Tampilkan form
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // Kirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate(['email'=>'required|email|exists:users,email']);
        $email = $request->email;

        // Generate OTP
        $otp = rand(100000, 999999);

        // Simpan OTP di DB sementara (misal table password_resets)
        DB::table('password_resets')->updateOrInsert(
            ['email'=>$email],
            [
                'token'=>Hash::make($otp),
                'created_at'=>now()
            ]
        );

        // Kirim email OTP
        \Mail::raw("Kode OTP Anda: $otp", function($message) use($email){
            $message->to($email)->subject('OTP Reset Password');
        });

        return response()->json(['success'=>true,'message'=>'OTP berhasil dikirim ke email']);
    }
    
    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6'
        ]);

        $record = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$record) {
            return response()->json(['success'=>false, 'message'=>'OTP tidak ditemukan']);
        }

        if (!Hash::check($request->otp, $record->token)) {
            return response()->json(['success'=>false, 'message'=>'OTP salah']);
        }

        return response()->json(['success'=>true, 'message'=>'OTP benar']);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'otp'=>'required|digits:6',
            'password'=>'required|min:6|confirmed'
        ]);

        $record = DB::table('password_resets')->where('email',$request->email)->first();
        if(!$record) {
            return response()->json(['success'=>false,'message'=>'OTP tidak ditemukan']);
        }

        if(!\Hash::check($request->otp,$record->token)) {
            return response()->json(['success'=>false,'message'=>'OTP salah']);
        }


        // Update password user
        $user = User::where('email',$request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus record OTP
        DB::table('password_resets')->where('email',$request->email)->delete();

        return response()->json(['success'=>true,'message'=>'Password berhasil diubah']);
    }
}
