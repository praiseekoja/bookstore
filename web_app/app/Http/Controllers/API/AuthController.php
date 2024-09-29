<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Models\DevCredentials;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\OTPEmail;

class AuthController extends Controller
{
    function register(Request $request) {
        $credentials = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:auth,email',
            'username' => 'required|unique:auth,username',
            'password' => 'required|min:8',
            'deviceId' => 'required|min:5'
        ]);

        $userId = Str::orderedUuid();

        $user = User::create([
            'id' => $userId, 'email' => $credentials['email'],
            'username' => $credentials['username'], 'userId' => $userId,
            'password' => Hash::make($credentials['password']), 'deviceId' => $credentials['deviceId'] ?? ""
        ]);

        $profile = Profile::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'], 'userId' => $userId
        ]);

        $token = $user->createToken($credentials['username'], ['*'], now()->addYear());
        // $request->session()->regenerate();
        // $request->session()->put('user', $user->userId);

        return response([
            'User' => $user,
            'token' => $token->plainTextToken
        ], 200);
    }

    function login(Request $request) {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required|min:8',
            'deviceId' => 'required|min:5'
        ]);

        $user = User::whereRaw('auth.username = ? or auth.email = ?', array($credentials['user'], $credentials['user']))
        // ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

        if (Hash::check($credentials['password'], $user->password)) {
            if($user['deviceId'] != $credentials['deviceId']){
                $otp = mt_rand(1000000, 9999999);

                User::where('userId', $user->userId)
                ->update([
                    'otp' => $otp,
                ]);

                Mail::to($user->email)->send(new OTPEmail([
                    'title' => 'Verify New Device',
                    'body' => "Use this code to verify your new device\nOTP Code: ".$otp
                ]));

                return response([
                    'message' => 'verify user OTP sent!',
                    'user' => $user,
                ], 201);
            }

            $token = $user->createToken($user->username, ['*'], now()->addYear());

            return response([
                'user' => $user,
                'token' => $token->plainTextToken
            ], 200);
        }

        return response(['message' => 'Password not correct'], 401);
    }

    function checkEmail(Request $request, $email) {
        $user = User::where('email', $email)
        ->select(['email'])
        ->first();

        if($user == null)
            return response(['message' => 'Email address not found'], 404);

        //200 found
        return response(['message' => 'Email address already exist'], 200);
    }

    function checkUsername(Request $request, $username) {
        $user = User::where('username', $email)
        ->select(['username'])
        ->first();

        if($user == null)
            return response(['message' => 'Username not found'], 404);

        //200 found
        return response(['message' => 'Username already exist'], 200);
    }

    function forgetPassword(Request $request, $user) {

    }

    function changePassword(Request $request) {
        $credentials = $request->validate([
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8'
        ]);

        if(Hash::check($credentials['old_password'], $request->user()->password)){
            $request->user()->password = Hash::make($credentials['password']);
            $request->user()->save();

            return response(['Password changed successfully'], 200);
        }

        return response(['Old password is invalid'], 401);
    }

    function changeEmail(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|unique:auth,email|string',
        ]);

        $request->user()->email = $credentials['email'];
        $request->user()->save();

        return response(['Email address changed successfully'], 200);
    }

    function changeUsername(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|unique:auth,username|string'
        ]);

        $request->user()->username = $credentials['username'];
        $request->user()->save();

        return response(['Username changed successfully'], 200);

    }

    function resendOTP(Request $request, $id){
        $user = User::whereRaw('auth.userid = ?', array($id))
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

        $otp = mt_rand(1000000, 9999999);

        User::where('userId', $user->userId)
        ->update([
            'otp' => $otp,
        ]);

        Mail::to($user->email)->send(new OTPEmail([
            'title' => 'Verify New Device',
            'body' => "Use this code to verify your new device\nOTP Code: ".$otp
        ]));

        return response([
            'message' => 'OTP sent!'
        ], 200);
    }

    function verifyOTP(Request $request, $id){
        $data = $request->validate([
            'otp' => 'required|min:7|max:7',
        ]);

        $user = User::whereRaw('auth.userid = ?', array($id))
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

        if($user->otp == $data['otp']){
            $token = $user->createToken($user->username, ['*'], now()->addYear());

            return response([
                'User' => $user,
                'token' => $token->plainTextToken
            ], 200);
        }

        return response(['message' => 'Invalid OTP!', 400]);
    }

    // function createDev(Request $request) {
    //     $dev = new DevCredentials();

    //     $ayo = $dev->createToken('Ayo:Dev', ['*']);
    //     $cheto = $dev->createToken('Praise:Dev', ['*']);
    //     $collins = $dev->createToken('Collins:Dev', ['*']);

    //     return[
    //         'Ayo' => $ayo->plainTextToken,
    //         'Cheto' => $cheto->plainTextToken,
    //         'Collins' => $collins->plainTextToken
    //     ];
    // }
}
