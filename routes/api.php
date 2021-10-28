<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/registration', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);


Route::group(['middleware'=> ['auth:sanctum']], function (){
    Route::apiResource('/posts', PostController::class);
    Route::post('/user/logout', [UserController::class, 'logout']);
});

