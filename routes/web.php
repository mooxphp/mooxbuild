<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\FirewallRuleController;
use App\Http\Controllers\PageTemplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('authors', AuthorController::class);
        Route::resource('carts', CartController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('comments', CommentController::class);
        Route::resource('continents', ContinentController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('currencies', CurrencyController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('firewall-rules', FirewallRuleController::class);
        Route::resource('items', ItemController::class);
        Route::resource('languages', LanguageController::class);
        Route::get('media', [MediaController::class, 'index'])->name(
            'media.index'
        );
        Route::post('media', [MediaController::class, 'store'])->name(
            'media.store'
        );
        Route::get('media/create', [MediaController::class, 'create'])->name(
            'media.create'
        );
        Route::get('media/{media}', [MediaController::class, 'show'])->name(
            'media.show'
        );
        Route::get('media/{media}/edit', [
            MediaController::class,
            'edit',
        ])->name('media.edit');
        Route::put('media/{media}', [MediaController::class, 'update'])->name(
            'media.update'
        );
        Route::delete('media/{media}', [
            MediaController::class,
            'destroy',
        ])->name('media.destroy');

        Route::resource('orders', OrderController::class);
        Route::resource('pages', PageController::class);
        Route::resource('page-templates', PageTemplateController::class);
        Route::resource('platforms', PlatformController::class);
        Route::resource('posts', PostController::class);
        Route::resource('postal-codes', PostalCodeController::class);
        Route::resource('products', ProductController::class);
        Route::resource('revisions', RevisionController::class);
        Route::resource('seos', SeoController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('tags', TagController::class);
        Route::resource('timezones', TimezoneController::class);
        Route::resource('users', UserController::class);
    });
