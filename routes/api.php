<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

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



Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('auth:api')->get('users',               [UserController::class, 'index']);
Route::middleware('auth:api')->get('user/{ID}',           [UserController::class, 'show']);
Route::middleware('auth:api')->post('user_new',           [UserController::class, 'store']);
Route::middleware('auth:api')->post('user_edit/{ID}',     [UserController::class, 'edit']);
Route::middleware('auth:api')->delete('user_delete/{ID}', [UserController::class, 'destroy']);

Route::middleware('auth:api')->get('movies',               [MovieController::class, 'index']);
Route::middleware('auth:api')->get('movie/{ID}',           [MovieController::class, 'show']);
Route::middleware('auth:api')->post('movie_new',           [MovieController::class, 'store']);
Route::middleware('auth:api')->post('movie_edit/{ID}',     [MovieController::class, 'edit']);
Route::middleware('auth:api')->delete('movie_delete/{ID}', [MovieController::class, 'destroy']);