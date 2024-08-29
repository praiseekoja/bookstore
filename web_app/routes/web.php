<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSpaceController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;


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


Route::get('/about', [StoreController::class, 'showAbout'])->name('about');

Route::get('/videos', [StoreController::class, 'showVideo'])->name('video');


Route::get('/book/{id}', [StoreController::class, 'showDetails'])->whereUuid('id')->name('books');


Route::get('/store', [StoreController::class, 'showShop'])->name('store');

Route::get('/store/class/{id}', [StoreController::class, 'showClass'])->name('store.class');

Route::get('/store/subject/{id}', [StoreController::class, 'showSubject'])->name('store.subject');

Route::get('/contact', [StoreController::class, 'showContact'])->name('contact');

Route::post('/cart', [StoreController::class, 'addCart']);


// Route::get('/login', function () {
//     return view('login');
// })->name('login');


// Route::get('/register', function () {
//     return view('register');
// })->name('register');


Route::get('/cart', [StoreController::class, 'showCart'])->name('cart');
Route::patch('/cart', [StoreController::class, 'updateCart']);
Route::delete('/cart/{id}', [StoreController::class, 'removeItem']);

Route::get('/payment/{id}', [StoreController::class, 'verifyPayment']);


Route::get('/checkout', [StoreController::class, 'showCheckout'])->name('checkout');


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


Route::get('/overseer/subjects/{id}', [AdminController::class, 'editSubject'])->name('admin.subject.edit');


//video

Route::get('/overseer/video', [AdminController::class, 'showVideo'])->name('admin.video');


Route::get('/overseer/video/add', [AdminController::class, 'addVideo'])->name('admin.video.add');


Route::get('/overseer/video/{id}', [AdminController::class, 'editVideo'])->name('admin.video.edit');


//book

Route::get('/overseer/books', [AdminController::class, 'showBooks'])->name('admin.book');


Route::get('/overseer/books/add', [AdminController::class, 'addBook'])->name('admin.book.add');


Route::get('/overseer/books/{id}', [AdminController::class, 'editBook'])->name('admin.book.edit');


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



//ajax request

//admin

Route::post('/subject', [AjaxController::class, 'addSubject']);

Route::patch('/subject/{id}', [AjaxController::class, 'updateSubject']);


Route::post('/class', [AjaxController::class, 'addClass']);

Route::patch('/class/{id}', [AjaxController::class, 'updateClass']);

Route::post('/video', [AjaxController::class, 'addVideo']);

Route::patch('/video/{id}', [AjaxController::class, 'updateVideo']);

Route::patch('/user/{id}', [AjaxController::class, 'updateUser']);

Route::post('/book', [AjaxController::class, 'addBook']);

Route::patch('/book/{id}', [AjaxController::class, 'updateBook']);

Route::patch('/auth/admin', [AjaxController::class, 'updateSec']);

Route::patch('/admin', [AjaxController::class, 'updateAdmin']);

Route::delete('user/{id}', [AjaxController::class, 'deleteUser']);

Route::delete('book/{id}', [AjaxController::class, 'deleteBook']);

Route::delete('subject/{id}', [AjaxController::class, 'deleteSubject']);

Route::delete('class/{id}', [AjaxController::class, 'deleteClass']);


//user

Route::patch('/auth/user', [UserSpaceController::class, 'updateSec']);
Route::patch('/user', [UserSpaceController::class, 'profileEdit']);
