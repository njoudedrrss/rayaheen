<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});
Route::get('/hello', function () {
    return "Hello World!";
  });
  Route::get('/books', [BookController::class, 'indexweb'])->name('books.index');
  Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
  Route::delete('books/{books}', [BookController::class, 'destroy'])->name('books.destroy');

  //create new product
Route::get('books/create', [BookController::class, 'create'])->name('books.create');
Route::post('books/store', [BookController::class, 'store'])->name('books.store');   

Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');

//Category
  Route::get('/Category', [CategoryController::class, 'indexweb'])->name('Category.index');
    Route::get('/Category/{Category}/edit', [CategoryController::class, 'edit'])->name('Category.edit');
  Route::delete('Category/{Category}', [CategoryController::class, 'destroy'])->name('Category.destroy');
Route::get('Category/Category', [CategoryController::class, 'create'])->name('Category.create');

Route::post('Category/store', [CategoryController::class, 'store'])->name('Category.store');   
Route::put('/Category/{Category}', [CategoryController::class, 'update'])->name('Category.update');
//users
  Route::get('/users', [UserController::class, 'indexweb'])->name('user.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
  Route::post('users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
  Route::get('users/{user}', [UserController::class, 'cart'])->name('user.cart');

Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
