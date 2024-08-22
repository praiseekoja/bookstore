<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSpaceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/**
 * Store Routes
 */

Route::get('/', [StoreController::class, 'showHome'])->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/book/{id}', [StoreController::class, 'showDetails'])->whereUuid('id')->name('books');


Route::get('/store', [StoreController::class, 'showShop'])->name('store');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Route::get('/login', function () {
//     return view('login');
// })->name('login');


// Route::get('/register', function () {
//     return view('register');
// })->name('register');

// routes/web.php



Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');



/**
 * authentication Routes
 */

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login-post');
Route::post('overseer/login', [LoginController::class, 'loginAdmin'])->name('login-admin');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register-post');
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

/**
 * Admin Dashboard Routes
 */


 Route::get('/overseer/login', function () {
    return view('auth.login2');
})->name('admin.login');


Route::get('/overseer/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');


Route::get('/overseer/transactions', [AdminController::class, 'showTransaction'])->name('admin.transactions');


Route::get('/overseer/edit', [AdminController::class, 'showProfile'])->name('admin.edit');


//classes

Route::get('/overseer/class', [AdminController::class, 'showClasses'])->name('admin.class');


Route::get('/overseer/class/add', [AdminController::class, 'addClass'])->name('admin.class.add');


Route::get('/overseer/class/{id}', [AdminController::class, 'editClass'])->name('admin.class.edit');


//subject

Route::get('/overseer/subjects', [AdminController::class, 'showSubjects'])->name('admin.subject');


Route::get('/overseer/subjects/add', [AdminController::class, 'addSubject'])->name('admin.subject.add');


Route::get('/overseer/subjects/edit', [AdminController::class, 'editSubject'])->name('admin.subject.edit');


//book

Route::get('/overseer/books', [AdminController::class, 'showBooks'])->name('admin.book');


Route::get('/overseer/books/add', function () {
    return view('admin.book.add-book');
})->name('admin.book.add');


Route::get('/overseer/books/edit', function () {
    return view('admin.book.edit-book');
})->name('admin.book.edit');


//user

Route::get('/overseer/users', [AdminController::class, 'showUsers'])->name('admin.user');


Route::get('/overseer/users/{id}', [AdminController::class, 'editUser'])->name('admin.user.edit');



/**
 * User Dashboard Routes
 */


Route::get('/user/{username}/library', [UserSpaceController::class, 'showLibrary'])->name('user.library');


Route::get('/user/dashboard', [UserSpaceController::class, 'showDashboard'])->name('user.dashboard');


Route::get('/user/{username}/transactions', [UserSpaceController::class, 'showTransaction'])->name('user.transaction');


Route::get('/user/{username}/watchlist', [UserSpaceController::class, 'showWishlist'])->name('user.watchlist');


Route::get('/user/{username}/update', [UserSpaceController::class, 'showProfileEdit'])->name('user.edit');


Route::get('/user/{username}', [UserSpaceController::class, 'showProfile'])->name('user.profile');
