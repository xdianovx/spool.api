<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PartnersCompanyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ViewController as AdminViewController;
use App\Http\Controllers\Partner\ViewController as PartnerViewController;
use App\Http\Controllers\ProfileController;
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

    Route::middleware('partner')->prefix('partner_views')->group(function () {
        Route::get('/all',  [PartnerViewController::class, 'index'])->name('partner_views.index');
        Route::get('/search',  [PartnerViewController::class, 'search'])->name('partner_views.search');
        Route::get('/{video}/show',  [PartnerViewController::class, 'show'])->name('partner_view.show');
    });

    Route::middleware('admin')->prefix('admin_views')->group(function () {
        Route::get('/all',  [AdminViewController::class, 'indexView'])->name('admin_views.index');
        Route::get('/search',  [AdminViewController::class, 'searchView'])->name('admin_views.search');
        Route::get('/{video}/show',  [AdminViewController::class, 'showView'])->name('admin_view.show');
    });

    Route::middleware('admin')->prefix('users')->group(function () {
        Route::get('/all',  [UserController::class, 'index'])->name('users.index');
        Route::get('/search',  [UserController::class, 'search'])->name('users.search');
        Route::get('/create',  [UserController::class, 'create'])->name('user.create');
        Route::post('/',  [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/show',  [UserController::class, 'show'])->name('user.show');
        Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}/update',  [UserController::class, 'update'])->name('user.update');
        Route::patch('/{user}/update_password',  [UserController::class, 'updatePassword'])->name('user.update_password');
        Route::delete('/{user}/destroy',  [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::middleware('admin')->prefix('clients')->group(function () {
        Route::get('/all',  [ClientController::class, 'index'])->name('clients.index');
        Route::get('/search',  [ClientController::class, 'search'])->name('clients.search');
        Route::get('/{client}/show',  [ClientController::class, 'show'])->name('client.show');
        Route::patch('/{client}',  [ClientController::class, 'send_ban'])->name('client.send_ban');
        Route::delete('/{client}/destroy',  [ClientController::class, 'destroy'])->name('client.destroy');
    });

    Route::middleware('admin')->prefix('countries')->group(function () {
        Route::get('/all',  [CountryController::class, 'index'])->name('countries.index');
        Route::get('/search',  [CountryController::class, 'search'])->name('countries.search');
        Route::get('/create',  [CountryController::class, 'create'])->name('country.create');
        Route::post('/',  [CountryController::class, 'store'])->name('country.store');
        Route::get('/{country}/show',  [CountryController::class, 'show'])->name('country.show');
        Route::get('/{country}/edit',  [CountryController::class, 'edit'])->name('country.edit');
        Route::patch('/{country}',  [CountryController::class, 'update'])->name('country.update');
        Route::delete('/{country}/destroy',  [CountryController::class, 'destroy'])->name('country.destroy');
    });

    Route::middleware('admin')->prefix('categories')->group(function () {
        Route::get('/all',  [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create',  [CategoryController::class, 'create'])->name('category.create');
        Route::get('/{category_slug}/create-child-category',  [CategoryController::class, 'createChild'])->name('category.create_child');
        Route::post('/',  [CategoryController::class, 'store'])->name('category.store');
        Route::post('/sort',  [CategoryController::class, 'sort'])->name('category.sort');
        Route::get('/{category_slug}/show',  [CategoryController::class, 'show'])->name('category.show');
        Route::get('/{category_slug}/edit',  [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/{category_parent_slug}/edit-child-category/{category_slug}',  [CategoryController::class, 'editChild'])->name('category.edit_child');
        Route::patch('/{category_slug}',  [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category_slug}/destroy',  [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::middleware('admin')->prefix('videos')->group(function () {
        Route::get('/all',  [VideoController::class, 'index'])->name('videos.index');
        Route::get('/search',  [VideoController::class, 'search'])->name('videos.search');
        Route::get('/create',  [VideoController::class, 'create'])->name('video.create');
        Route::post('/',  [VideoController::class, 'store'])->name('video.store');
        Route::get('/{video}/show',  [VideoController::class, 'show'])->name('video.show');
        Route::get('/{video}/edit',  [VideoController::class, 'edit'])->name('video.edit');
        Route::patch('/{video}',  [VideoController::class, 'update'])->name('video.update');
        Route::delete('/{video}/destroy',  [VideoController::class, 'destroy'])->name('video.destroy');
    });

    Route::middleware('admin')->prefix('partners_companies')->group(function () {
        Route::get('/all',  [PartnersCompanyController::class, 'index'])->name('partners_companies.index');
        Route::get('/search',  [PartnersCompanyController::class, 'search'])->name('partners_companies.search');
        Route::get('/create',  [PartnersCompanyController::class, 'create'])->name('partners_company.create');
        Route::post('/',  [PartnersCompanyController::class, 'store'])->name('partners_company.store');
        Route::get('/{partners_company}/show',  [PartnersCompanyController::class, 'show'])->name('partners_company.show');
        Route::get('/{partners_company}/edit',  [PartnersCompanyController::class, 'edit'])->name('partners_company.edit');
        Route::patch('/{partners_company}',  [PartnersCompanyController::class, 'update'])->name('partners_company.update');
        Route::delete('/{partners_company}/destroy',  [PartnersCompanyController::class, 'destroy'])->name('partners_company.destroy');
    });
    Route::middleware('admin')->prefix('tags')->group(function () {
        Route::get('/{video_id}', [TagController::class, 'getAll']);
        Route::post('/{video_id}',  [TagController::class, 'store'])->name('tag.store');
        Route::get('/{tag}/edit',  [TagController::class, 'edit'])->name('tag.edit');
        Route::patch('/{tag}',  [TagController::class, 'update'])->name('tag.update');
        Route::post('/',  [TagController::class, 'display'])->name('tag.display');
        Route::delete('/destroy/{tag}',  [TagController::class, 'destroy'])->name('tag.destroy');
    });
    Route::middleware('admin')->prefix('tickets')->group(function () {
        Route::get('/all',  [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/search',  [TicketController::class, 'search'])->name('tickets.search');
        Route::get('/create',  [TicketController::class, 'create'])->name('ticket.create');
        Route::post('/',  [TicketController::class, 'store'])->name('ticket.store');
        Route::get('/{ticket}/show',  [TicketController::class, 'show'])->name('ticket.show');
        Route::get('/{ticket}/edit',  [TicketController::class, 'edit'])->name('ticket.edit');
        Route::patch('/{ticket}',  [TicketController::class, 'update'])->name('ticket.update');
        Route::delete('/{ticket}/destroy',  [TicketController::class, 'destroy'])->name('ticket.destroy');
    });
    Route::middleware('admin')->prefix('settings')->group(function () {
        Route::get('/all',  [SettingController::class, 'index'])->name('settings.index');
        Route::get('/search',  [SettingController::class, 'search'])->name('settings.search');
        Route::get('/create',  [SettingController::class, 'create'])->name('setting.create');
        Route::post('/',  [SettingController::class, 'store'])->name('setting.store');
        Route::get('/{setting}/show',  [SettingController::class, 'show'])->name('setting.show');
        Route::get('/{setting}/edit',  [SettingController::class, 'edit'])->name('setting.edit');
        Route::patch('/{setting}',  [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/{setting}/destroy',  [SettingController::class, 'destroy'])->name('setting.destroy');
    });
});

require __DIR__ . '/auth.php';
