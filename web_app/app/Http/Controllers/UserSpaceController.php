<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

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
