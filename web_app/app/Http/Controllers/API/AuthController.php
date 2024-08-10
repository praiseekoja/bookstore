<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request) {
        $credentials = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:auth,email',
            'username' => 'required|unique:auth,username',
            'password' => 'required|min:8'
        ]);

        $userId = Str::orderedUuid();
        $user = new User();
        $token = $user->createToken($credentials['username'], ['*'], now()->addYear());

        $user = User::create([
            'userId' => $userId, 'email' => $credentials['email'],
            'username' => $credentials['username'], 'remember_token' => $token->plainTextToken,
            'password' => Hash::make($credentials['password']), 'deviceId' => ''
        ]);

        $profile = Profile::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'], 'userId' => $userId
        ]);

        return [
            'User' => $user,
            'User_details' => $profile,
            'token' => $token->plainTextToken
        ];
    }
}
