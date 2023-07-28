<?php

use App\Http\Controllers\API\V1\Clients\AuthController;
use App\Http\Controllers\API\V1\Clients\ProfileController;
use App\Http\Controllers\API\V1\Countries\CountryController;
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
    //auth
    Route::post('account/login', [AuthController::class, 'login'])->middleware('throttle:3,1440');
    Route::post('account/login/confirm', [AuthController::class, 'login_confirm']);
    Route::post('account/login/profile', [AuthController::class, 'login_profile']);
    Route::post('account/logout', [AuthController::class, 'logout']);
    Route::post('account/refresh', [AuthController::class, 'refresh']);
    //profile
    Route::get('profile', [ProfileController::class, 'userProfile']);    
    Route::post('profile/email', [ProfileController::class, 'profileEmail']);   
    Route::post('profile/country', [ProfileController::class, 'profilePostCountry']);  
    Route::post('profile/name', [ProfileController::class, 'profileName']);
    Route::post('profile/age', [ProfileController::class, 'profileAge']);
    Route::post('profile/avatar', [ProfileController::class, 'profileAvatar']);
    Route::post('profile/email/confirm', [ProfileController::class, 'profileEmailConfirm']);
    //country
    Route::get('country', [CountryController::class, 'getCountry']); 
});

Route::get('/v1/ping', function () {
    return response()->json([
        'message' => 'success',
        'status' => 200
    ]);
});
