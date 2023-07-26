<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('users')->group(function () {
        Route::get('/all',  [UserController::class, 'index'])->name('users.index');
        Route::get('/create',  [UserController::class, 'create'])->name('user.create');
        Route::post('/',  [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/show',  [UserController::class, 'show'])->name('user.show');
        Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}',  [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}/destroy',  [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('countries')->group(function () {
        Route::get('/all',  [CountryController::class, 'index'])->name('countries.index');
        // Route::get('/create',  [CountryController::class, 'create'])->name('user.create');
        // Route::get('/',  [CountryController::class, 'store'])->name('user.store');
        // Route::get('/{country}',  [CountryController::class, 'show'])->name('country.show');
        // Route::get('/{country}/edit',  [CountryController::class, 'edit'])->name('country.edit');
        // Route::get('/{country}',  [CountryController::class, 'destroy'])->name('country.destroy');
    });
});

require __DIR__.'/auth.php';
