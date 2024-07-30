<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwetsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[TwetsController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

 // tweets
Route::get('/my-twets', [TwetsController::class,'mytwets'])->middleware(['auth', 'verified'])->name('mytwets');
Route::post('/twets', [TwetsController::class,'created'])->middleware(['auth', 'verified'])->name('create.twets');
Route::get('/edit-post/{id}', [TwetsController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit.twets');
Route::put('/update-post/{id}', [TwetsController::class, 'update'])->middleware(['auth', 'verified'])->name('update.twets');
Route::delete('/twets/{id}',[TwetsController::class,'destroy'])->middleware(['auth', 'verified'])->name('twets.destroy');
Route::get('/show-twets/{slug}',[TwetsController::class,'show'])->middleware(['auth', 'verified'])->name('show.twets');

//coment
Route::post('/coment/{id}',[CommentController::class,'created'])->middleware(['auth', 'verified'])->name('coment');
Route::post('delete-coment/{id}',[CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('delete.coment');
Route::get('/coba',[TwetsController::class,'coba'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';