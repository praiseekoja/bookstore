<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //
    function create(Request $request) {
        $data = $request->validate([
            'cost' => 'required'
        ]);

        $cart = Cart::where('user', $request->user()->userId)
        ->get();

        if ($cart != null) {
            $trans = Transaction::create([
                'cost' => $data['cost'],
                'user' => $request->user()->userId,
                'details' => json_encode($cart)
            ]);

            if($trans != null){

                $carts = DB::table('cart')
                ->where('user', $request->user()->userId)
                ->delete();

                return response(['message' => 'saved'], 200);
            }
        }

        return response(['message' => 'User don\'t have any item in their cart']);
    }

    function getTransactions(Request $request) {
        $trans = Transaction::where('user', $request->user()->userID)
        ->take(100)
        ->get();

        if($trans == null)
            return response(['message' => 'No record found'], 404);

        return response(['message' => 'found', 'data' => $trans], 200);
    }
}
