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

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('account/login', [AuthController::class, 'login']);
    Route::post('account/register', [AuthController::class, 'register']);
    Route::post('account/logout', [AuthController::class, 'logout']);
    Route::post('account/refresh', [AuthController::class, 'refresh']);
    Route::get('account/client-profile', [AuthController::class, 'clientProfile']);    
});

Route::get('/v1/ping', function () {
    return response()->json([
        'message' => 'success',
        'status' => 200
    ]);
});
