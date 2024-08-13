<?php

namespace App\Http\Controllers\API;

use App\Models\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    function getWishlist(Request $request) {
        $saved_items = Wishlist::where('wishlist.user_id', $request->user()->userId)
        ->leftjoin('book', 'wishlist.book_ref', '=', 'book.book_id')
        ->take(100)
        ->get();

        if($saved_items == null)
            return response(['message' => 'No item found'], 404);

        return response(['message' => 'Saved Items found', 'data' => $saved_items], 200);
    }

    function create(Request $request) {
        $data = $request->validate([
            'book_id' => 'required',
        ]);

        $wishlist = Wishlist::create([
            'book_ref' => $data['book_id'],
            'user_id' => $request->user()->userId
        ]);

        if($wishlist == null)
            return response(['message' => 'An error occured'], 400);


        return response(['message' => 'Saved!'], 200);
    }

    function deleteWishlist(Request $request, $id) {
        $row = DB::table('book')
        ->where('id', $id)
        ->delete();

        if ($row > 0) {
            return response(['message' => 'Item deleted'], 200);
        }

        return response(['message' => 'Item does not exist'], 400);
    }
}
