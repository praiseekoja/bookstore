<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

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
}
