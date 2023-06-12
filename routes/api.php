<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('messages', MessageController::class);
    Route::resource('history', HistoriesController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
