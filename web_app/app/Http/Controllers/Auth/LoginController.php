<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        ]);

        $req = Request::create(self::$url."login", 'POST', [
            'user' => $data['user'],
            'password' => $data['password']
        ], [], [], [
            'HTTP_AUTHORIZATION' => "bearer ".self::$token
        ]);
        $req->headers->set('Accept', 'application/json');
        // $req->headers->set('Authorization', "Bearer ".self::$token);
        $res = Route::dispatch($req);
        $content = json_decode($res->getContent());

        if($res->getStatusCode() == 200){
            $request->session()->regenerate();
            $request->session()->put('user', $content->user->userId);

            return response()->json([
                'message' => "success",
            ], 200);
        }

        return response()->json([
            'message' => "Incorrect password or username/email"
        ], 400);
    }
}

