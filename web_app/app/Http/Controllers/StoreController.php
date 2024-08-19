<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel;
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
            'newBooks' => $this->getNewBooks(),
            'bestSelling' => $this->getBestSelling(),
            'random' => $this->getRandom()
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
}
