<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSpaceController;
use App\Http\Controllers\StoreController;


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


Route::get('/cart', function () {
    return view('cart');
})->name('cart');



/**
 * authentication Routes
 */

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login-post');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register-post');
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

/**
 * Admin Dashboard Routes
 */


Route::get('/overseer/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('/overseer/transactions', function () {
    return view('admin.transactions');
})->name('admin.transactions');


Route::get('/overseer/transactions', function () {
    return view('admin.transactions');
})->name('admin.transactions');


Route::get('/overseer/edit', function () {
    return view('admin.edit');
})->name('admin.edit');


//classes

Route::get('/overseer/classes', function () {
    return view('admin.class.classes');
})->name('admin.class');


Route::get('/overseer/classes/add', function () {
    return view('admin.class.add-class');
})->name('admin.class.add');


Route::get('/overseer/classes/edit', function () {
    return view('admin.class.edit-class');
})->name('admin.class.edit');


//subject

Route::get('/overseer/subjects', function () {
    return view('admin.subject.subjects');
})->name('admin.subject');


Route::get('/overseer/subjects/add', function () {
    return view('admin.subject.add-subject');
})->name('admin.subject.add');


Route::get('/overseer/subjects/edit', function () {
    return view('admin.subject.edit-subject');
})->name('admin.subject.edit');


//book

Route::get('/overseer/books', function () {
    return view('admin.book.books');
})->name('admin.book');


Route::get('/overseer/books/add', function () {
    return view('admin.book.add-book');
})->name('admin.book.add');


Route::get('/overseer/books/edit', function () {
    return view('admin.book.edit-book');
})->name('admin.book.edit');


//user

Route::get('/overseer/users', function () {
    return view('admin.user.users');
})->name('admin.user');


Route::get('/overseer/users/edit', function () {
    return view('admin.user.edit-user');
})->name('admin.user.edit');









/**
 * User Dashboard Routes
 */


Route::get('/user/{username}/library', [UserSpaceController::class, 'showLibrary'])->name('user.library');


Route::get('/user/dashboard', [UserSpaceController::class, 'showDashboard'])->name('user.dashboard');


Route::get('/user/{username}/transactions', [UserSpaceController::class, 'showTransaction'])->name('user.transaction');


Route::get('/user/{username}/watchlist', [UserSpaceController::class, 'showWishlist'])->name('user.watchlist');


Route::get('/user/{username}/update', [UserSpaceController::class, 'showProfileEdit'])->name('user.edit');


Route::get('/user/{username}', [UserSpaceController::class, 'showProfile'])->name('user.profile');
