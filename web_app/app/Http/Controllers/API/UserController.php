<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function getUser(Request $request, $userId) {
        $user = User::where('auth.userId', $userId)
        ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
        ->first();

        if($user == null)
            return response(['message' => 'User not found'], 404);

            return response(['message' => 'User found', 'data' => $user], 200);
    }

    function getUsers(Request $request) {
        $user = User::leftjoin('profile', 'auth.userId', '=', 'profile.userId')
        ->take(100)
        ->get();

        if($user == null)
            return response(['message' => 'No users found'], 404);

            return response(['message' => 'Users found', 'data' => $user], 200);
    }

    function updateUser(Request $request) {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required_without',
            'address' => 'required_without',
            // 'profile_image' => 'required_without|mimes:jpeg,bmp,png,jpg|max:1024'
        ]);

        $uploaded = true;
        $imagUrl = null;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $nam = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $path = 'storage/app/public/user/';
            if ($file->move($path, $nam)){
                $uploaded = true;
                $imagUrl = "{$path}{$nam}";
            }
            else{
                $uploaded = false;
                return response(['message' => 'An error occured when uploading image'], 500);
            }
        }

        if($uploaded){
            Profile::where('userId', $request->user()->userId)
            ->update([
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'tel' => $data['phone'], 'address' => $data['address'],
                'profile_image' => $imagUrl
            ]);

            return response(['message' => 'Profile updated successfully'], 200);
        }

        return response(['message' => 'An unknown error occured'], 500);
    }

    function getCatalog(Request $request) {
        return response([
            'books' => $this->getBooks($request->user()->userId),
            'message' => 'cataglog fetched!'
        ]);

    }

    private function getBooks($userId)
    {
        return DB::table('user_collections')
            ->whereRaw('user_collections.userId = ?', array($userId))
            ->leftjoin('book', 'user_collections.book_id', '=', 'book.book_id')
            ->orderBy('user_collections.created_at', 'desc')
            ->take(100)
            ->get();
    }
}
