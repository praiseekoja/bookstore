<?php

namespace App\Http\Controllers\Auth;

use App\Models\AdminModel;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    private static $url = '/api/auth/';
    private static $token = '1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f';//'1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'user' => 'required',
            'password' => 'required',
            'deviceId' => 'required|min:5'
        ]);

        $req = Request::create(self::$url."login", 'POST', [
            'user' => $data['user'],
            'password' => $data['password'],
            'deviceId' => $data['deviceId'],
        ], [], [], [
            'HTTP_AUTHORIZATION' => "bearer ".self::$token
        ]);
        $req->headers->set('Accept', 'application/json');
        // $req->headers->set('Authorization', "Bearer ".self::$token);
        $res = Route::dispatch($req);
        $content = json_decode($res->getContent());

        if($res->getStatusCode() == 201){
            $request->session()->forget('device_user');
            $request->session()->regenerate();
            $request->session()->put('device_user', $content->user->userId);

            return response()->json([
                'message' => "success", 'status' => 201
            ], 201);
        }
        else if($res->getStatusCode() == 200){
            $request->session()->forget('user');
            $request->session()->regenerate();
            $request->session()->put('user', $content->user->userId);
            $request->session()->put('deviceId', $data['deviceId']);

            return response()->json([
                'message' => "success", 'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => "Incorrect password or username/email"
        ], 400);
    }

    function showOtp(Request $request) {
        return view('auth.device-otp');
    }

    public function loginAdmin(Request $request)
    {
        $data = $request->validate([
            'user' => 'required',
            'password' => 'required|min:8',
        ]);

        $admin = AdminModel::whereRaw('username = ? or email = ?', array($data['user'], $data['user']))
        ->first();

        if($admin == null)
            return response(['message' => 'User not found'], 404);

        if (Hash::check($data['password'], $admin->password)) {

            $request->session()->regenerate();
            $request->session()->put('overseer', $admin->adminId);
            return response([
                'message' => "Success",
            ], 200)->cookie('overseer', self::$token, 2628000, '/', null, false, false, false);
        }

        return response(['message' => 'Password not correct'], 401);

    }

    function verifyOtp(Request $request, $otp) {
        $data = $request->validate([
            'deviceId' => 'required|min:25',
        ]);
        if (!$request->session()->has('device_user'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $userId = session('device_user');
        $user = User::whereRaw('auth.userId = ?', array($userId))
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

        if($user->otp != $otp)
            return response()->json(['message' => 'Invalid OTP!'], 400);

        User::where('userId', $user->userId)
        ->update([
            'deviceId' => $data['deviceId'],
        ]);

        $request->session()->forget('user');
        $request->session()->regenerate();
        $request->session()->put('user', $user->userId);
        Cookie::queue('deviceId', $data['deviceId']);

        return response()->json(['message' => 'OTP Verified'], 200);

    }
}

