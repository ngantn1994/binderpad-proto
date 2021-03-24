<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    return "test";
});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', [AuthenticatedSessionController::class, 'getUserInfo']);
Route::middleware('auth:sanctum')->post('/profileUpdate', [UserInfoController::class, 'update']);

Route::middleware('auth:sanctum')->post('/createNewPost', [PostController::class, 'store']);

Route::middleware('auth:sanctum')->get('/getAllPost', [PostController::class, 'getAll']);
