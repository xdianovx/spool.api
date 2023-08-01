<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PartnersCompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Partners_company;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('users')->group(function () {
        Route::get('/all',  [UserController::class, 'index'])->name('users.index');
        Route::get('/search',  [UserController::class, 'search'])->name('users.search');
        Route::get('/create',  [UserController::class, 'create'])->name('user.create');
        Route::post('/',  [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/show',  [UserController::class, 'show'])->name('user.show');
        Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}',  [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}/destroy',  [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('clients')->group(function () {
        Route::get('/all',  [ClientController::class, 'index'])->name('clients.index');
        Route::get('/search',  [ClientController::class, 'search'])->name('clients.search');
        Route::get('/{client}/show',  [ClientController::class, 'show'])->name('client.show');
        Route::patch('/{client}',  [ClientController::class, 'send_ban'])->name('client.send_ban');
        Route::delete('/{client}/destroy',  [ClientController::class, 'destroy'])->name('client.destroy');
    });

    Route::prefix('countries')->group(function () {
        Route::get('/all',  [CountryController::class, 'index'])->name('countries.index');
        Route::get('/search',  [CountryController::class, 'search'])->name('countries.search');
        Route::get('/create',  [CountryController::class, 'create'])->name('country.create');
        Route::post('/',  [CountryController::class, 'store'])->name('country.store');
        Route::get('/{country}/show',  [CountryController::class, 'show'])->name('country.show');
        Route::get('/{country}/edit',  [CountryController::class, 'edit'])->name('country.edit');
        Route::patch('/{country}',  [CountryController::class, 'update'])->name('country.update');
        Route::delete('/{country}',  [CountryController::class, 'destroy'])->name('country.destroy');
    });

    Route::prefix('partners_companies')->group(function () {
        Route::get('/all',  [PartnersCompanyController::class, 'index'])->name('partners_companies.index');
        Route::get('/search',  [PartnersCompanyController::class, 'search'])->name('partners_companies.search');
        Route::get('/create',  [PartnersCompanyController::class, 'create'])->name('partners_company.create');
        Route::post('/',  [PartnersCompanyController::class, 'store'])->name('partners_company.store');
        Route::get('/{partners_company}/show',  [PartnersCompanyController::class, 'show'])->name('partners_company.show');
        Route::get('/{partners_company}/edit',  [PartnersCompanyController::class, 'edit'])->name('partners_company.edit');
        Route::patch('/{partners_company}',  [PartnersCompanyController::class, 'update'])->name('partners_company.update');
        Route::delete('/{partners_company}',  [PartnersCompanyController::class, 'destroy'])->name('partners_company.destroy');
    });
});

require __DIR__.'/auth.php';
