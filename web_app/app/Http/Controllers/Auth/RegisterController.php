<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    private static $url = '/api/auth/';
    private static $token = '1|llsMVtuMnY9vXsdygvbnhv7d3TjOksNSQcTkEmR20270ac6f';

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:auth,username',
            'email' => 'required|email|max:255|unique:auth,email',
            'password' => 'required|string|min:8|confirmed',
            'deviceId' => 'required|min:25'
        ]);


        $req = Request::create(self::$url."register", 'POST', [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'deviceId' => $data['deviceId'],
        ], [], [], [
            'HTTP_AUTHORIZATION' => "bearer ".self::$token
        ]);
        $req->headers->set('Accept', 'application/json');
        $res = Route::dispatch($req);
        $content = json_decode($res->getContent());

        if($res->getStatusCode() == 200){
            $user = User::whereRaw('auth.username = ?', array($data['username']))
            ->first();
            $request->session()->regenerate();
            $request->session()->put('user', $user->userId);
            $request->session()->put('deviceId', $data['deviceId']);

            return response()->json([
                'message' => "success",
            ], 200);
        }

        return response()->json([
            'message' => 'An error occurred'
        ], 400);
    }
}
