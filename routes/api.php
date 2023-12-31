<?php

use App\Http\Controllers\API\V1\Categories\CategoryController;
use App\Http\Controllers\API\V1\Clients\AuthController;
use App\Http\Controllers\API\V1\Clients\ProfileController;
use App\Http\Controllers\API\V1\Countries\CountryController;
use App\Http\Controllers\API\V1\Pay\PayController;
use App\Http\Controllers\API\V1\Settings\SettingController;
use App\Http\Controllers\API\V1\Tags\TagController;
use App\Http\Controllers\API\V1\Tickets\ClientTicketController;
use App\Http\Controllers\API\V1\Tickets\TicketController;
use App\Http\Controllers\API\V1\Videos\VideoController;
use App\Http\Controllers\API\V1\Views\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    Route::group([
        'middleware' => 'headers'
    ], function ($router) {
        //auth
        Route::post('account/login', [AuthController::class, 'login'])->middleware('apiThrottle:30,1440');
        Route::post('account/login/confirm', [AuthController::class, 'login_confirm']);
        // Route::middleware('jwt.verify')->group(function () {
        Route::post('account/login/profile', [AuthController::class, 'login_profile']);
        Route::post('account/logout', [AuthController::class, 'logout']);
        Route::post('account/refresh', [AuthController::class, 'refresh']);
        //profile
        Route::get('profile', [ProfileController::class, 'userProfile']);
        Route::post('profile/email', [ProfileController::class, 'profileEmail']);
        Route::post('profile/country', [ProfileController::class, 'profilePostCountry']);
        Route::post('profile/name', [ProfileController::class, 'profileName']);
        Route::post('profile/age', [ProfileController::class, 'profileAge']);
        Route::post('profile/gender', [ProfileController::class, 'profileGender']);
        Route::post('profile/phone', [ProfileController::class, 'profilePhone']);
        Route::post('profile/avatar', [ProfileController::class, 'profileAvatar']);
        Route::post('profile/email/confirm', [ProfileController::class, 'profileEmailConfirm']);

        Route::get('profile/user_activity', [ProfileController::class, 'user_activity']);

        Route::get('profile/cards', [ProfileController::class, 'profileCards']);
        Route::delete('profile/cards/{card_id}', [ProfileController::class, 'destroy']);

        Route::delete('profile/remove', [ProfileController::class, 'profileRemove']);

        //countries
        Route::get('countries', [CountryController::class, 'getCountries']);
        //categories
        Route::get('categories', [CategoryController::class, 'getCategories']);
        Route::get('categories/{category_slag}', [CategoryController::class, 'getCategory']);
        //videos
        Route::get('videos', [VideoController::class, 'getVideosAndCategories']);
        Route::get('videos/category/{category_slag?}/{cild_category_slag?}', [VideoController::class, 'getVideosAndCategoriesBySlag']);
        Route::get('videos/{video_id}', [VideoController::class, 'getVideoById']);
        Route::get('videos/{video_id}/load', [VideoController::class, 'getVideoLoad']);
        //search
        Route::get('search', [VideoController::class, 'getVideosAndCategoriesBySearch']);
        //settings
        Route::get('settings', [SettingController::class, 'getSettings']);
        //tickets
        Route::get('tickets', [TicketController::class, 'getTickets']);
        Route::get('tickets/purchased', [ClientTicketController::class, 'getClientTicket']);
        //views create
        Route::post('videos/view_store', [ViewController::class, 'storeView']);

    });

    // Pay  Временные роуты
    Route::get('pay', [PayController::class, 'all']);
    Route::post('pays', [PayController::class, 'getPayData']);

    //buying a ticket
    Route::post('pay/store', [PayController::class, 'getPayData']);
    Route::post('tickets/rebill', [ClientTicketController::class, 'rebillClientTicket']);

});

Route::get('/v1/ping', function () {
    return response()->json([
        'message' => 'success',
        'status' => 200
    ]);
});