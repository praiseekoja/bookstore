<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Models\DevCredentials;
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

        $user = User::create([
            'id' => $userId, 'email' => $credentials['email'],
            'username' => $credentials['username'], 'userId' => $userId,
            'password' => Hash::make($credentials['password']), 'deviceId' => ''
        ]);

        $profile = Profile::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'], 'userId' => $userId
        ]);

        $token = $user->createToken($credentials['username'], ['*'], now()->addYear());

        return [
            'User' => $user,
            'User_details' => $profile,
            'token' => $token->plainTextToken
        ];
    }

    function login(Request $request) {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::where('username', $credentials['user'])
        ->where('email', $credentials['user'])
        ->join('profile', 'auth.userId', '=', 'profile.userId')
        ->firstOr(function (){
            abort(404, 'User not found');
        });

        if ($user != null && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken($user->username, ['*'], now()->addYear());
            return [
                'user' => $user,
                'token' => $token
            ];
        }

        about(401, 'Password not correct');
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
