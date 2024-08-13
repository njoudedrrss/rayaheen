<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::post('password/email', [UserController::class, 'sendResetLinkEmail']);

   
    Route::post('/register', [UserController::class, 'register']);

Route::get('password/email', [EmailVerificationNotificationController::class, 'store']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
      Route::post('/resetpassword', [UserController::class, 'reset']);
Route::get('books', [BookController::class, 'index']);
Route::Post('category', [CategoryController::class, 'index']);
    Route::post('/login', [UserController::class, 'login']);

    Route::post('/logout', [UserController::class, 'logout']);
    Route::middleware('auth:sanctum')->group(function () {
    Route::post('cart', [CartController::class, 'addToCart']);
    Route::get('cart', [CartController::class, 'viewCart']);
    Route::put('cart/{id}', [CartController::class, 'updateCartItem']);
    Route::delete('removecart/{id}', [CartController::class, 'removeCartItem']);
    Route::get('totalprice', [CartController::class, 'totalpricetocart']);
        Route::Post('pay', [CartController::class, 'bill']);
        Route::post('editprofile',[UserController::class ,'editprofile']);

});
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
