<?php

// app/Http/Controllers/Auth/LogoutController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');
        return redirect()->route('login');
    }

    public function logoutAdmin(Request $request)
    {
        // Auth::logout();
        $request->session()->forget('overseer');
        return redirect()->route('login');
    }
}
