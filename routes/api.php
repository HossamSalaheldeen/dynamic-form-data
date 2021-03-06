<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthController;

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

Route::post('events/{id}/login',[AuthController::class,'login']);
Route::post('events/{id}/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('events/{id}/user', [AuthController::class,'user']);
    Route::post('events/{id}/logout', [AuthController::class,'logout']);
});
