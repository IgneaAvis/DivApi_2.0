<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/requests', [\App\Http\Controllers\Api\V1\BidsController::class, 'createBid']);
Route::post('/register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/requests', [\App\Http\Controllers\Api\V1\BidsController::class, 'index']);
    Route::put('/requests/{id}', [\App\Http\Controllers\Api\V1\BidsController::class, 'updateBid']);
});

