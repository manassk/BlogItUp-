<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts', [PostController::class , 'index'])
        ->name('posts.index');
    Route::get('/posts/create', [PostController::class , 'create'])
        ->name('posts.create');
    Route::post('/posts', [PostController::class , 'store'])
        ->name('posts.store');
    Route::get('/posts/{id}', [PostController::class , 'show'])
        ->name('posts.show');
    Route::get('/user/posts', [userPostController::class , 'index'])
        ->name('posts.userPost');
    Route::get('edit/{id}', [PostController::class , 'edit']);
    Route::put('update-data/{id}',[PostController::class , 'update']);
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/comments/{postId}', [CommentController::class , 'store'])
    ->name('comments.store');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});

require __DIR__.'/auth.php';
