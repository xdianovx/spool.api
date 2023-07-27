<?php

use App\Http\Controllers\API\V1\Clients\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('account/login', [AuthController::class, 'login']);
    Route::post('account/login/confirm', [AuthController::class, 'login_confirm']);
    Route::post('account/login/profile', [AuthController::class, 'login_profile']);
    Route::post('account/logout', [AuthController::class, 'logout']);
    Route::post('account/refresh', [AuthController::class, 'refresh']);
    Route::get('account/user-profile', [AuthController::class, 'userProfile']);    
});

Route::get('/v1/ping', function () {
    return response()->json([
        'message' => 'success',
        'status' => 200
    ]);
});
