<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSpaceController extends Controller
{
    //
    function showDashboard(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.dashboard')->with([
                'user' => $user,
                'totalLib' => $this->getTotalLibrary($userId),
                'totalPur' => $this->getTotalPurchased($userId),
                'totalSpent' => $this->getTotalSpent($userId),
                'totalWish' => $this->getTotalWishlist($userId),
                'recentBooks' => $this->getRecentBook($userId),
                'recentTrans' => $this->getRecentTransaction($userId),
                'title' => 'Dashboard'
            ]);
        }

        return redirect()->route('login');
    }

    function showLibrary(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.collections')->with([
                'user' => $user,
                'books' => $this->getBooks($userId),
                'title' => 'Library'
            ]);
        }

        return redirect()->route('login');
    }

    function showProfile(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.profile')->with([
                'user' => $user,
                'title' => $user->first_name.' - Profile'
            ]);
        }

        return redirect()->route('login');
    }

    function showTransaction(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.transactions')->with([
                'user' => $user,
                'recentTrans' => $this->getTransactions($userId),
                'title' => 'Transactions'
            ]);
        }

        return redirect()->route('login');
    }

    function showWishlist(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.watchlist')->with([
                'user' => $user,
                'items' => $this->getSavedItems($userId),
                'title' => 'Saved Items'
            ]);
        }

        return redirect()->route('login');
    }

    function showProfileEdit(Request $request) {
        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('auth.userId', $userId)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            return view('user.edit')->with([
                'user' => $user,
                'title' => $user->first_name.' - Edit Profile'
            ]);
        }

        return redirect()->route('login');
    }


    function profileEdit(Request $request) {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'tel' => 'required_without',
            'addr' => 'required_without',
        ]);

        if ($request->session()->has('user')) {
            $userId = session('user');

            $user = User::where('userId', $userId)
            ->first();

            $profile = Profile::where('userId', $userId)
            ->first();

            if($user == null || $profile == null)
                abort(401);

            $emai = User::where('userId', '<>', $userId)
            ->where('email', $data['email'])
            ->first();

            if($emai != null)
                return response()->json([
                    'message' => 'Email address already exist'
                ], 409);

            $userna = User::where('userId', '<>', $userId)
            ->where('username', $data['username'])
            ->first();

            if($userna != null)
                return response()->json([
                    'message' => 'Username address already exist'
                ], 409);


            $user->username = $data['username'];
            $user->email = $data['email'];

            $profile->first_name = $data['first_name'];
            $profile->last_name = $data['last_name'];
            $profile->tel = $data['tel'];
            $profile->address = $data['addr'];

            $user->save();
            $profile->save();

            return response()->json([
                'message' => 'Updated!!'
            ], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    function updateSec(Request $request) {
        if (!$request->session()->has('user'))
            return response()->json(['message' => 'Unauthorized'], 401);

        $userId = session('user');
        $user = User::where('userId', $userId)
        ->first();

        if($user == null)
            return response()->json(['message' => 'Unauthorized'], 401);

        $data = $request->validate([
            'old_psw' => 'required|string|min:8',
            'psw' => 'required|string|min:8'
        ]);

        if(Hash::check($data['old_psw'], $user->password)){
            $user->password = Hash::make($data['psw']);
            $user->save();

            return response()->json([
                'message' => "Saved!"
            ], 200);
        }

        return response()->json([
            'message' => "Invalid old password!"
        ], 400);

    }






    private function getTotalLibrary($userId)
    {
        return DB::table('user_collections')
            ->whereRaw('userId = ? and book_id <> null', array($userId))->count();
    }

    private function getTotalPurchased($userId)
    {
        return DB::table('transaction')
            ->whereRaw('user = ?', array($userId))->count();
    }

    private function getTotalSpent($userId)
    {
        return DB::table('transaction')
            ->whereRaw('user = ?', array($userId))->sum('cost');;
    }

    private function getTotalWishlist($userId)
    {
        return DB::table('wishlist')
            ->whereRaw('user_id = ? and book_ref <> null', array($userId))->count();
    }

    private function getRecentBook($userId)
    {
        return DB::table('user_collections')
            ->whereRaw('user_collections.userId = ? and user_collections.book_id <> null', array($userId))
            ->leftjoin('book', 'user_collections.book_id', '=', 'book.book_id')
            ->orderBy('user_collections.created_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getBooks($userId)
    {
        return DB::table('user_collections')
            ->whereRaw('user_collections.userId = ? and user_collections.book_id <> null', array($userId))
            ->leftjoin('book', 'user_collections.book_id', '=', 'book.book_id')
            ->orderBy('user_collections.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getRecentTransaction($userId)
    {
        return DB::table('transaction')
            ->whereRaw('user = ?', array($userId))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getTransactions($userId)
    {
        return DB::table('transaction')
            ->whereRaw('user = ?', array($userId))
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getSavedItems($userId)
    {
        return DB::table('wishlist')
            ->whereRaw('wishlist.user_id = ? and wishlist.book_ref <> null', array($userId))
            ->leftjoin('book', 'wishlist.book_ref', '=', 'book.book_id')
            ->orderBy('wishlist.created_at', 'desc')
            ->take(20)
            ->get();
    }
}
