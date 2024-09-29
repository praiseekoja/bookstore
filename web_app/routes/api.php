<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\TransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/email/{email}', [AuthController::class, 'checkEmail']);
    Route::get('/username/{username}', [AuthController::class, 'checkUsername']);
    Route::get('/forget-password/{user}', [AuthController::class, 'forgetPassword']);
    Route::patch('/change-password', [AuthController::class, 'changePassword']);
    Route::patch('/change-email', [AuthController::class, 'changeEmail']);
    Route::patch('/chamge-username', [AuthController::class, 'changeUsername']);
});


Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [UserController::class, 'getUsers']);
    Route::get('/catalog', [UserController::class, 'getCatalog']);
    Route::get('/{userId}', [UserController::class, 'getUser'])->whereUuid("userId");
    Route::patch('', [UserController::class, 'UpdateUser']);
    // Route::patch('/{userId}', [UserController::class, 'UpdateUser'])->whereUuid("userId");
});


Route::prefix('class')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [ClassController::class, 'getClasses']);

    Route::post('', [ClassController::class, 'create']);
    Route::get('/{id}', [ClassController::class, 'getClass']);
    Route::patch('/{id}', [ClassController::class, 'UpdateClass']);
    Route::delete('/{id}', [ClassController::class, 'deleteClass']);
});

Route::prefix('subject')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [SubjectController::class, 'getSubjects']);

    Route::post('', [SubjectController::class, 'create']);
    Route::get('/{id}', [SubjectController::class, 'getSubject']);
    Route::patch('/{id}', [SubjectController::class, 'UpdateSubject']);
    Route::delete('/{id}', [SubjectController::class, 'deleteSubject']);
});

Route::prefix('transaction')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [TransactiontController::class, 'getTransactions']);
    Route::post('', [TransactionController::class, 'create']);
    // Route::delete('/{id}', [TransactionController::class, 'deleteTransaction']);
});

Route::prefix('saved-items')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [WishlistController::class, 'getWishlist']);
    Route::post('', [WishlistController::class, 'create']);
    Route::delete('/{id}', [WishlistController::class, 'deleteWishlist']);
});


Route::prefix('book')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [BookController::class, 'getBooks']);
    Route::get('/search', [BookController::class, 'findBooks']);
    Route::get('/popular', [BookController::class, 'getPopular']);
    Route::post('', [BookController::class, 'create']);
    Route::get('{id}', [BookController::class, 'getBook'])->whereUuid("id");
    Route::patch('/{id}', [BookController::class, 'updateBook'])->whereUuid("id");
    Route::delete('/{id}', [BookController::class, 'deleteBook'])->whereUuid("id");
});


Route::prefix('cart')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [CartController::class, 'getCart']);
    Route::post('', [CartController::class, 'create']);
    Route::patch('{id}', [CartController::class, 'updateCart']);
    Route::delete('/{id}', [CartController::class, 'deleteCart']);
});


// Route::post('/dev', [AuthController::class, 'createDev']);

