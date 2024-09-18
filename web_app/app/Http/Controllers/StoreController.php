<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\Cart;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
// use Flutterwave\Transactions;
// use Flutterwave\Rave;

class StoreController extends Controller
{
    //
    function showHome(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('home')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'newBooks' => $this->getNewBooks(),
            'bestSelling' => $this->getBestSelling(),
            'videos' => $this->getFewVideos(),
            'random' => $this->getRandom()
        ]);
    }

    function showShop(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('shop')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'books' => $this->getBooks()
        ]);
    }

    function showClass(Request $request, $id) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('shop')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'books' => $this->getClass($id)
        ]);
    }

    function showSubject(Request $request, $id) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('shop')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'books' => $this->getSubject($id)
        ]);
    }

    function showDetails(Request $request, $id) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('book')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'book' => $this->getBook($id)
        ]);
    }

    function showAbout(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('about')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
        ]);
    }

    function showContact(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('contact')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
        ]);
    }

    function showVideo(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('video')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'videos' => $this->getVideos()
        ]);
    }
    
    function showVideoSub(Request $request, $id) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;
        if ($request->session()->has('user')) {
            $userId = session('user');
            $cart_num = $this->countCart($userId);
        }

        return view('video-subject')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num,
            'videos' => $this->getVideosSub($id)
        ]);
    }

    function showCart(Request $request) {
        if ($request->session()->has('user')) {
            $subjects = Subject::take(30)
            ->get();

            $classes = ClassModel::take(30)
            ->get();

            $cart_num = 0;

            $userId = session('user');
            $cart_num = $this->countCart($userId);

            return view('cart')->with([
                'subjects' => $subjects,
                'classes' => $classes,
                'cartCount' => $cart_num,
                'carts' => $this->getCartItems($userId)
            ]);
        }

        return redirect()->route('login');
    }

    function addCart(Request $request) {
        if (!$request->session()->has('user'))
            return response()->json(['message' => 'Sign-in before adding items to your cart'], 401);

        $userId = session('user');

        $data = $request->validate([
            'qty' => 'required',
            'format' => 'required',
            'book_id' => 'required'
        ]);

        $item = Cart::where('book', $data['book_id'])
        ->where('user', $userId)
        ->first();

        if($item != null){
            $item->qty = $data['qty'];
            $item->format = $data['format'];
            $item->save();

            return response()->json(['message' => 'Cart updated'], 200);
        }else {
            $item = Cart::create([
                'qty' => $data['qty'],
                'format' => $data['format'],
                'book' => $data['book_id'],
                'user' => $userId
            ]);

            if($item != null)
                return response()
            ->json(['message' => 'Item added to cart', 'data' => $item], 200);
        }

        return response()
        ->json(['message' => 'Unknown error occured'], 400);
    }

    function updateCart(Request $request) {
        if (!$request->session()->has('user'))
            return response()->json(['message' => 'Sign-in before updates items in your cart'], 401);

        $userId = session('user');

        $data = $request->validate([
            'qty' => 'required',
            'id' => 'required'
        ]);

        $item = Cart::where('id', $data['id'])
        ->where('user', $userId)
        ->first();

        $item->qty = $data['qty'];
        $item->save();
        return response()->json([
            'message' => 'Updated!!'
        ], 200);
    }

    function removeItem(Request $request, $id) {
        if (!$request->session()->has('user'))
            return response()->json(['message' => 'Sign-in before updates items in your cart'], 401);

        $userId = session('user');

        $item = DB::table('cart')
        ->where('id', $id)
        ->where('user', $userId)
        ->delete();

        if($item > 0)
            return response()->json([
                'message' => 'Updated!!'
            ], 200);

        return response()->json([
            'message' => 'Item already deleted'
        ], 400);
    }

    function showCheckout(Request $request) {
        if ($request->session()->has('user')) {
            $subjects = Subject::take(30)
            ->get();

            $classes = ClassModel::take(30)
            ->get();

            $cart_num = 0;

            $userId = session('user');
            $user = User::where('userId', $userId)
            ->first();

            $profile = Profile::where('userId', $userId)
            ->first();
            $cart_num = $this->countCart($userId);

            return view('checkout')->with([
                'subjects' => $subjects,
                'classes' => $classes,
                'cartCount' => $cart_num,
                'carts' => $this->getCartItems($userId),
                'user' => $user,
                'profile' => $profile
            ]);
        }

        return redirect()->route('login');
    }

    function verifyPayment(Request $request, $id) {
        $flw_key = env('FLW_SECRET_KEY');
        $client = new Client();
        $response = $client->request('GET', "https://api.flutterwave.com/v3/transactions/verify_by_reference?tx_ref={$id}", [
            'headers' => [
                'Authorization' => "Bearer {$flw_key}",
                'Content-Type'  => 'application/json',
            ],
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);

        // Check the payment status
        if (isset($responseBody['data']['status']) && $responseBody['data']['status'] == 'successful') {

                try {
                    return response()->json([
                    'message' => 'Payment successful!!'
                    ], 200);
                } catch (\Throwable $e) {
                    return response()->json([
                        'message' => 'Payment successful!!'
                        ], 200);
                } finally {
                    $userId = session('user');

                    $cartItem = $this->getCartItems($userId);
                    $cost = 0;
                    foreach ($cartItem as $item) {
                        if($item->format == 'hard')
                            $cost += $item->price2;
                        else
                            $cost += $item->price;
                        
                        if($this->checkUserCollection($userId, $item->book_id) == 0){
                            $result = DB::table('user_collections')->insert([
                                'userId' => $userId,
                                'book_id' => $item->book_id
                            ]);
                        }
                    }
                    
                    $data = $request->validate([
                        'first_name' => 'required_without',
                        'last_name' => 'required_without',
                        'phone' => 'required_without',
                        'email' => 'required_without',
                        'state' => 'required_without',
                        'address' => 'required_without',
                        'company' => 'required_without'
                    ]);

                    $result = DB::table('transaction')->insert([
                        'cost' => $cost,
                        'details' => json_encode($cartItem),
                        'user' => $userId,
                        'shipping_details' => json_encode($data)
                    ]);


                    DB::table('cart')
                    ->where('user', $userId)
                    ->delete();
                }

        } else {
            return response()->json([
                'message' => 'Payment not successfull'
            ], 400);
        }
    }

    function showOrderSent(Request $request) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;

        $cart_num = $this->countCart('$userId');

        return view('order')->with([
            'subjects' => $subjects,
            'classes' => $classes,
            'cartCount' => $cart_num
        ]);
    }

    function showTransactionDetails(Request $request, $id) {
        $subjects = Subject::take(30)
        ->get();

        $classes = ClassModel::take(30)
        ->get();

        $cart_num = 0;

        if($request->session()->has('user')){
            $userId = session('user');
            $cart_num = $this->countCart($userId);

            return view('transaction')->with([
                'subjects' => $subjects,
                'classes' => $classes,
                'cartCount' => $cart_num,
                'carts' => $this->getUserTransaction($id, $userId)
            ]);
        }
        elseif ($request->session()->has('overseer')) {
            return view('transaction')->with([
                'subjects' => $subjects,
                'classes' => $classes,
                'cartCount' => $cart_num,
                'carts' => $this->getTransaction($id)
            ]);
        }
        else {
            abort(404);
        }
    }





    private function checkUserCollection($userId, $bookId)
    {
        return DB::table('user_collections')
            ->whereRaw('userId = ? and book_id = ?', array($userId, $bookId))->count();
    }

    private function countCart($userId)
    {
        return DB::table('cart')
            ->whereRaw('user = ?', array($userId))->count();
    }

    private function getNewBooks()
    {
        return DB::table('book')
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(3)
            ->get();
    }

    private function getBooks()
    {
        return DB::table('book')
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getClass($id)
    {
        return DB::table('book')
            ->where('book.class_id', $id)
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getSubject($id)
    {
        return DB::table('book')
            ->where('book.subject_id', $id)
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getBestSelling()
    {
        return DB::table('book')
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(8)
            ->get();
    }

    private function getRandom()
    {
        return DB::table('book')
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->orderBy('book.created_at', 'desc')
            ->take(3)
            ->get();
    }

    private function getBook($id)
    {
        return DB::table('book')
            ->where('book.book_id', $id)
            ->leftjoin('subject', 'book.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'book.class_id', '=', 'class.id')
            ->first();
    }

    private function getVideos(){
        return DB::table('video_links')
            ->leftjoin('subject', 'video_links.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'video_links.class_id', '=', 'class.id')
            ->orderBy('video_links.created_at', 'desc')
            ->take(100)
            ->get();
    }
    
    private function getVideosSub($id){
        return DB::table('video_links')
            ->where('video_links.subject_id', $id)
            ->leftjoin('subject', 'video_links.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'video_links.class_id', '=', 'class.id')
            ->orderBy('video_links.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getFewVideos(){
        return DB::table('video_links')
            ->leftjoin('subject', 'video_links.subject_id', '=', 'subject.id')
            ->leftjoin('class', 'video_links.class_id', '=', 'class.id')
            ->orderBy('video_links.created_at', 'desc')
            ->take(3)
            ->get();
    }

    private function getCartItems($userId){
        return DB::table('cart')
        ->where('user', $userId)
        ->leftjoin('book', 'cart.book', '=', 'book.book_id')
        ->orderBy('cart.created_at', 'desc')
        ->get();
    }

    private function getTransaction($id)
    {
        return DB::table('transaction')
            ->whereRaw('id = ?', array($id))
            ->first();
    }

    private function getUserTransaction($id, $userId)
    {
        return DB::table('transaction')
            ->whereRaw('id = ? and user = ?', array($id, $userId))
            ->first();
    }
}
