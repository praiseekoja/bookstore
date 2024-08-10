<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getUser(Request $request, $userId) {
        $user = User::where('auth.userId', $userId)
        ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

            return response(['message' => 'User found', 'user' => $user], 200);
    }

    function getUsers(Request $request) {
        $user = User::leftjoin('profile', 'auth.userId', '=', 'profile.userId')
        ->take(50)
        ->get();

        if($user == null)
            return response(['message' => 'No users found'], 404);

            return response(['message' => 'Users found', 'user' => $user], 200);
    }

    function updateUser(Request $request) {
        
    }
}
