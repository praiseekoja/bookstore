<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\OTPEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    //
    function showForget(Request $request) {
        return view('auth.forget-password');
    }

    function showOtp(Request $request) {
        return view('auth.otp');
    }

    function showChangePassword(Request $request) {
        if ($request->session()->has('user_reset')) {
            return view('auth.change-password');
        }

        return abort(401);
    }

    function findUser(Request $request) {
        $data = $request->validate([
            'user' => 'required|string'
        ]);

        $user = User::where('email', $data['user'])
        ->orWhere('username', $data['user'])
        ->first();

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->session()->regenerate();
        $request->session()->put('user_reset', $user->userId);

        $otp = mt_rand(100000, 999999);

        $request->session()->regenerate();
        $request->session()->put('user_otp', $otp);

        Mail::to($user->email)->send(new OTPEmail([
            'title' => 'Use this code to reset password',
            'body' => 'OTP Code: '.$otp
        ]));

        return response()->json(['message' => 'OTP sent!'], 200);
    }

    function changePassword(Request $request) {
        if (!$request->session()->has('user_reset'))
            return response()->json(['message' => 'User not found'], 400);

        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('userId', session('user_reset'))
        ->first();

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($data['password']);
        $request->session()->regenerate();
        $request->session()->put('user', $user->userId);
        $user->save();

        $request->session()->forget('user_reset');
        $request->session()->forget('user_otp');

        return response()->json(['message' => 'Password Reset Successfully'], 200);
    }

    function verifyOtp(Request $request, $id) {
        if (!$request->session()->has('user_reset'))
            return response()->json(['message' => 'Unauthorized'], 401);

        if (!$request->session()->has('user_otp'))
            return response()->json(['message' => 'Session expired'], 400);

        if(session('user_otp') == $id)
            return response()->json(['message' => 'OTP Verified'], 200);

        return response()->json(['message' => 'Invalid OTP'], 400);
    }

}
