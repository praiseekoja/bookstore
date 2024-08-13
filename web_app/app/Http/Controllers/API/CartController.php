<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    function create(Request $request) {
        $data = $request->validate([
            'qty' => 'required',
            'format' => 'required',
            'book_id' => 'required'
        ]);

        $item = Cart::where('book', $data['book_id'])
        ->where('user', $request->user()->userId)
        ->first();

        if($item != null){
            $item->qty = $data['qty'];
            $item->format = $data['format'];
            $item->save();

            return response(['message' => 'Cart updated'], 200);
        }else {
            $item = Cart::create([
                'qty' => $data['qty'],
                'format' => $data['format'],
                'book' => $data['book_id'],
                'user_id' => $request->user()->userId
            ]);

            if($item != null)
                return response(['message' => 'Item added to cart', 'data' => $item], 200);
        }

        return response(['message' => 'Unknown error occured'], 400);
    }

    function updateCart(Request $request, $id) {
        $data = $request->validate([
            'qty' => 'required',
            'format' => 'required',
        ]);

        $item = Cart::find($id);

        if($item){
            $item->qty = $data['qty'];
            $item->format = $data['format'];
            $item->save();

            return response(['message' => 'Cart updated'], 200);
        }
    }

    function getCart(Request $request) {
        $items = Cart::where('user', $request->user()->userId)
        ->leftjoin('book', 'cart.book', '=', 'book.book_id')
        ->take(50)
        ->get();

        if($items == null)
            return response(['message' => 'Nothing found'], 404);

        return response(['message' => 'Items found', 'data' => $items], 200);
    }

    function deleteCart(Request $request, $id) {
        $row = DB::table('cart')
        ->where('id', $id)
        ->delete();

        if ($row > 0) {
            return response(['message' => 'Item deleted'], 200);
        }

        return response(['message' => 'Item does not exist'], 400);
    }
}
