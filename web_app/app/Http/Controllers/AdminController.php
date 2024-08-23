<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Wishlist;
use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function showDashboard(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.dashboard')->with([
                'admin' => $user,
                'users' => $this->getTotalUser(),
                'books' => $this->getTotalBooks(),
                'classes' => $this->getTotalClass(),
                'subjects' => $this->getTotalSubject(),
                'recentBooks' => $this->getRecentBooks(),
                'recentSubjects' => $this->getRecentSubject(),
                'recentTrans' => $this->getRecentTransaction(),
                'title' => 'Dashboard'
            ]);
        }

        return view('Auth.login2');
    }

    function showUsers(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.user.users')->with([
                'admin' => $user,
                'users' => $this->getUsers(),
                'title' => 'Users'
            ]);
        }

        return view('Auth.login2');
    }

    function editUser(Request $request, $id) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            $user = User::where('auth.userId', $id)
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->first();

            if($user == null){
                abort(404);
            }

            return view('admin.user.edit-user')->with([
                'admin' => $admin,
                'user' => $user,
                'title' => 'Edit '.$user->username
            ]);
        }

        return view('Auth.login2');
    }

    function showClasses(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.class.classes')->with([
                'admin' => $user,
                'classes' => $this->getClasses(),
                'title' => 'Subjects'
            ]);
        }

        return view('Auth.login2');
    }

    function editClass(Request $request, $id) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            $class = ClassModel::where('id', $id)
            ->first();

            if($class == null)
                abort(404);

            return view('admin.class.edit-class')->with([
                'admin' => $admin,
                'class' => $class,
                'title' => 'Edit '.$class->class_name
            ]);
        }

        return view('Auth.login2');
    }

    function addClass(Request $request) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            return view('admin.class.add-class')->with([
                'admin' => $admin,
                'title' => 'Add Class'
            ]);
        }

        return view('Auth.login2');
    }

    function showSubjects(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.subject.subjects')->with([
                'admin' => $user,
                'subjects' => $this->getSubjects(),
                'title' => 'Subjects'
            ]);
        }

        return view('Auth.login2');
    }

    function editSubject(Request $request, $id) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            $subject = Subject::where('id', $id)
            ->first();

            if($subject == null)
                abort(404);

            return view('admin.subject.edit-subject')->with([
                'admin' => $admin,
                'subject' => $subject,
                'title' => 'Edit '.$subject->subject_name
            ]);
        }

        return view('Auth.login2');
    }

    function addSubject(Request $request) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            return view('admin.subject.add-subject')->with([
                'admin' => $admin,
                'title' => 'Add Subject'
            ]);
        }

        return view('Auth.login2');
    }

    function showTransaction(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.transactions')->with([
                'admin' => $user,
                'recentTrans' => $this->getTransactions(),
                'title' => 'Transactions'
            ]);
        }

        return view('Auth.login2');
    }

    function showProfile(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.edit')->with([
                'admin' => $user,
                'title' => 'Profile'
            ]);
        }

        return view('Auth.login2');
    }

    function showBooks(Request $request) {
        if ($request->session()->has('overseer')) {
            $id = session('overseer');

            $user = AdminModel::where('adminId', $id)
            ->first();

            return view('admin.book.books')->with([
                'admin' => $user,
                'books' => $this->getBooks(),
                'title' => 'Dashboard'
            ]);
        }

        return view('Auth.login2');
    }


    function editBook(Request $request, $id) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            $book = Book::where('book_id', $id)
            ->first();

            if($book == null)
                abort(404);

            return view('admin.book.edit-book')->with([
                'admin' => $admin,
                'book' => $book,
                'subjects' => $this->getTSubjects(),
                'classes' => $this->getTClasses(),
                'title' => 'Edit '.$book->title
            ]);
        }

        return view('Auth.login2');
    }

    function addBook(Request $request) {
        if ($request->session()->has('overseer')) {
            $idd = session('overseer');

            $admin = AdminModel::where('adminId', $idd)
            ->first();

            return view('admin.book.add-book')->with([
                'admin' => $admin,
                'subjects' => $this->getTSubjects(),
                'classes' => $this->getTClasses(),
                'title' => 'Add Book'
            ]);
        }

        return view('Auth.login2');
    }



    private function getTotalUser()
    {
        return DB::table('auth')
            ->count();
    }

    private function getTotalBooks()
    {
        return DB::table('book')
            ->count();
    }

    private function getTotalClass()
    {
        return DB::table('class')
            ->count();
    }

    private function getTClasses()
    {
        return DB::table('class')
            ->get();
    }

    private function getTotalSubject()
    {
        return DB::table('subject')
            ->count();
    }

    private function getTSubjects()
    {
        return DB::table('subject')
            ->get();
    }

    private function getRecentBooks()
    {
        return DB::table('book')
            ->orderBy('created_at', 'desc')
            ->take(5)
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

    private function getRecentSubject()
    {
        return DB::table('subject')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getRecentTransaction()
    {
        return DB::table('transaction')
            ->leftjoin('profile', 'transaction.user', '=', 'profile.userId')
            ->orderBy('transaction.created_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getTransactions()
    {
        return DB::table('transaction')
            ->leftjoin('profile', 'transaction.user', '=', 'profile.userId')
            ->orderBy('transaction.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getUsers(){
        return DB::table('auth')
            ->leftjoin('profile', 'auth.userId', '=', 'profile.userId')
            ->orderBy('auth.created_at', 'desc')
            ->take(100)
            ->get();
    }

    private function getClasses(){
        return DB::select('select `class`.*, (select count(*) from `book` where `class`.`id` = `book`.`class_id`) as `books_count` from `class`');
    }

    private function getSubjects(){
        return DB::select('select `subject`.*, (select count(*) from `book` where `subject`.`id` = `book`.`subject_id`) as `books_count` from `subject`');
    }
}
