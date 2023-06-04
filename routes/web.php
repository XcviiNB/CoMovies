<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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

Route::get('/', [SiteController::class, 'index']);

Route::get('/login', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);

Route::get('/user/register', [UserController::class, 'create']);
Route::post('/', [UserController::class, 'store']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [SiteController::class, 'logout']);

    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/add', [MovieController::class, 'create']);
    Route::post('movies', [MovieController::class, 'store']);
    Route::get('/movies/edit/{movie}', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);


    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/add', [RequestController::class, 'create']);
    Route::post('requests', [RequestController::class, 'store']);
});

// Route::group(['middleware' => ['auth', 'role:admin']], function () {
//     Route::get('/movies/edit/{movie}', [MovieController::class, 'edit'])->name('movies.edit');
//     Route::put('/movies/{movie}', [MovieController::class, 'update']);
//     Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
// });



