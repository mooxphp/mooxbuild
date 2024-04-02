<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\WpPostController;
use App\Http\Controllers\WpTermController;
use App\Http\Controllers\WpUserController;
use App\Http\Controllers\ExpiryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobBatchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WpOptionController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\FailedJobController;
use App\Http\Controllers\WpCommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobManagerController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\WpPostMetaController;
use App\Http\Controllers\WpTermMetaController;
use App\Http\Controllers\WpUserMetaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\FirewallRuleController;
use App\Http\Controllers\PageTemplateController;
use App\Http\Controllers\WpCommentMetaController;
use App\Http\Controllers\ExpiryMonitorController;
use App\Http\Controllers\ContentElementController;
use App\Http\Controllers\JobQueueWorkerController;
use App\Http\Controllers\WpTermTaxonomyController;
use App\Http\Controllers\JobBatchManagerController;
use App\Http\Controllers\WpTermRelationshipController;

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
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('activity-logs', ActivityLogController::class);
        Route::resource('addresses', AddressController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('carts', CartController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('comments', CommentController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('contents', ContentController::class);
        Route::resource('content-elements', ContentElementController::class);
        Route::resource('continents', ContinentController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('currencies', CurrencyController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('failed-jobs', FailedJobController::class);
        Route::resource('firewall-rules', FirewallRuleController::class);
        Route::resource('items', ItemController::class);
        Route::resource('jobs', JobController::class);
        Route::resource('job-batches', JobBatchController::class);
        Route::resource('job-batch-managers', JobBatchManagerController::class);
        Route::resource('job-managers', JobManagerController::class);
        Route::resource('job-queue-workers', JobQueueWorkerController::class);
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
        Route::resource('routes', RouteController::class);
        Route::resource('seos', SeoController::class);
        Route::resource('sessions', SessionController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('syncs', SyncController::class);
        Route::resource('tags', TagController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('themes', ThemeController::class);
        Route::resource('timezones', TimezoneController::class);
        Route::resource('users', UserController::class);
        Route::resource('wishlists', WishlistController::class);
        Route::resource('wp-comments', WpCommentController::class);
        Route::resource('wp-comment-metas', WpCommentMetaController::class);
        Route::resource('wp-options', WpOptionController::class);
        Route::resource('wp-posts', WpPostController::class);
        Route::resource('wp-post-metas', WpPostMetaController::class);
        Route::resource('wp-terms', WpTermController::class);
        Route::resource('wp-term-metas', WpTermMetaController::class);
        Route::resource(
            'wp-term-relationships',
            WpTermRelationshipController::class
        );
        Route::resource('wp-term-taxonomies', WpTermTaxonomyController::class);
        Route::resource('wp-users', WpUserController::class);
        Route::resource('wp-user-metas', WpUserMetaController::class);
        Route::resource('expiries', ExpiryController::class);
        Route::resource('expiry-monitors', ExpiryMonitorController::class);
    });
