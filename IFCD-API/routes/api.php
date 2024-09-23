<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

 //Routes de user
 Route::post('/logout', [UserController::class, 'logout']);
 Route::get('/users', [UserController::class, 'index']);
 Route::get('/user/show/{id}', [UserController::class, 'show']);
 Route::post('/upload', [UserController::class, 'upload']); //image
 Route::post('/del_img',[UserController::class, 'deleteimg']);
 Route::post('/user/update/{id}', [UserController::class, 'update']);
 Route::delete('/user/delete-definitely/{id}', [UserController::class, 'delete']);
 Route::get('/user/search/{name}', [UserController::class, 'search']);
 Route::post('/register', [UserController::class, 'register']);
 Route::get('/user/online', [UserController::class, 'online']);


});