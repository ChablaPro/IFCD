<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CompagnyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JuridiqueController;
use App\Http\Controllers\MaillonController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
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
    Route::post('/del_img', [UserController::class, 'deleteimg']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete-definitely/{id}', [UserController::class, 'delete']);
    Route::get('/user/search/{name}', [UserController::class, 'search']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/user/online', [UserController::class, 'online']);


    //Arrondissements
    Route::get('/arrondissements', [ArrondissementController::class, 'index']);

    //Communes
    Route::get('/communes', [CommuneController::class, 'index']);

    //Departments
    Route::get('/departments', [DepartmentController::class, 'index']);

    //Juridiques
    Route::get('/juridiques', [JuridiqueController::class, 'index']);

    //Maillons
    Route::get('/maillons', [MaillonController::class, 'index']);

    //Positions
    Route::get('/positions', [PositionController::class, 'index']);

    //Villages
    Route::get('/villages', [VillageController::class, 'index']);

    //compagnies
    Route::get('/compagny/utilities', [CompagnyController::class, 'utilities']);
    Route::get('/compagny/paginate6', [CompagnyController::class, 'compagnies']);
    Route::post('/compagny/create', [CompagnyController::class, 'create']);
    Route::post('/compagny/update', [CompagnyController::class, 'update']);
    Route::post('/compagny/validate', [CompagnyController::class, 'validated']);
    Route::post('/compagny/delete', [CompagnyController::class, 'delete']);

    //compagnies
    Route::get('/actor/utilities', [ActorController::class, 'utilities']);
    Route::get('/actor/paginate6', [ActorController::class, 'actors']);
    Route::post('/actor/create', [ActorController::class, 'create']);
    Route::post('/actor/update', [ActorController::class, 'update']);
    Route::post('/actor/validate', [ActorController::class, 'validated']);
    Route::post('/actor/delete', [ActorController::class, 'delete']);
    Route::post('/actor/upload', [ActorController::class, 'upload']);
    Route::post('/actor/delete-img', [ActorController::class, 'deleteImg']);
});
