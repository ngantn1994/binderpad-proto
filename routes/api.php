<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BinderController;
use App\Http\Controllers\ReactionController;
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
Route::middleware('auth:sanctum')->get('/myprofile', [UserInfoController::class, 'getCurrentUser']);
Route::middleware('auth:sanctum')->get('/userprofile', [UserInfoController::class, 'getById']);

Route::middleware('auth:sanctum')->post('/createNewPost', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->post('/createNewBinder', [BinderController::class, 'store']);

Route::middleware('auth:sanctum')->get('/getAllPost', [PostController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/getMyPost', [PostController::class, 'getCurrentUser']);
Route::middleware('auth:sanctum')->get('/getUserPost', [PostController::class, 'getByUserId']);
Route::middleware('auth:sanctum')->post('/deletePost', [PostController::class, 'deletePost']);

Route::middleware('auth:sanctum')->post('/reactToPost', [ReactionController::class, 'store']);
Route::middleware('auth:sanctum')->get('/getPostReaction', [ReactionController::class, 'get']);
