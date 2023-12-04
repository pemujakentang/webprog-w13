<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//MACAM-MACAM IMPLEMENTASI ROUTES
Route::controller(BookController::class)->middleware('auth')->group(
    function(){
        Route::get('/create-book', 'create');
        Route::post('/books/new', 'store');
        Route::get('/books', 'index');
        Route::get('/books/{book:id}/edit', 'edit');
        Route::put('/books/{book:id}/update', 'update');
    }
);

// Route::controller(BookController::class)->group(
//     function(){
//         Route::get('/create-book', 'create')->middleware('auth');
//         Route::get('/books', 'index');
//     }
// );

// Route::middleware('auth')->group(
//     function(){
//         Route::get('/create-book', [BookController::class, 'create']);
//         Route::get('/books', [BookController::class, 'index']);
//     }
// );

// Route::controller(BookController::class)->group(
//     function(){
//         Route::get('/create-book', 'create');
//         Route::get('/books', 'index');
//     }
// );

//YANG INI GA JALAN
// Route::controller(BookController::class)->group(
//     function () {
//         Route::get('/create-book', 'create');
//         Route::get('/books', 'index');
//     }
// )->middleware('auth');

Route::middleware(['auth', 'admin'])->group(
    function(){
        Route::get('/admin/books', [BookController::class, 'admin']);
        Route::delete('/books/{book:id}/delete', [BookController::class, 'destroy']);
    }
);

require __DIR__.'/auth.php';
