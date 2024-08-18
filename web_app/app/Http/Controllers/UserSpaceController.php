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
            ->take(50)
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
}
