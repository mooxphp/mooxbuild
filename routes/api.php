<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeoController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\RevisionController;
use App\Http\Controllers\Api\TimezoneController;
use App\Http\Controllers\Api\ContinentController;
use App\Http\Controllers\Api\ItemItemsController;
use App\Http\Controllers\Api\PagePagesController;
use App\Http\Controllers\Api\PostPostsController;
use App\Http\Controllers\Api\PostalCodeController;
use App\Http\Controllers\Api\AuthorPostsController;
use App\Http\Controllers\Api\AuthorPagesController;
use App\Http\Controllers\Api\AuthorItemsController;
use App\Http\Controllers\Api\UserAuthorsController;
use App\Http\Controllers\Api\FirewallRuleController;
use App\Http\Controllers\Api\LanguageTagsController;
use App\Http\Controllers\Api\PageTemplateController;
use App\Http\Controllers\Api\CategoryPostsController;
use App\Http\Controllers\Api\CategoryItemsController;
use App\Http\Controllers\Api\CategoryPagesController;
use App\Http\Controllers\Api\CustomerCartsController;
use App\Http\Controllers\Api\LanguagePostsController;
use App\Http\Controllers\Api\LanguagePagesController;
use App\Http\Controllers\Api\LanguageItemsController;
use App\Http\Controllers\Api\PlatformSyncsController;
use App\Http\Controllers\Api\AuthorProductsController;
use App\Http\Controllers\Api\AuthorCommentsController;
use App\Http\Controllers\Api\ProductProductsController;
use App\Http\Controllers\Api\CategoryProductsController;
use App\Http\Controllers\Api\CountryTimezonesController;
use App\Http\Controllers\Api\CountryLanguagesController;
use App\Http\Controllers\Api\LanguageProductsController;
use App\Http\Controllers\Api\CountryCurrenciesController;
use App\Http\Controllers\Api\CurrencyCountriesController;
use App\Http\Controllers\Api\LanguageCountriesController;
use App\Http\Controllers\Api\PagePageTemplatesController;
use App\Http\Controllers\Api\TimezoneCountriesController;
use App\Http\Controllers\Api\ContinentCountriesController;
use App\Http\Controllers\Api\LanguageCategoriesController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('authors', AuthorController::class);

        // Author Posts
        Route::get('/authors/{author}/posts', [
            AuthorPostsController::class,
            'index',
        ])->name('authors.posts.index');
        Route::post('/authors/{author}/posts', [
            AuthorPostsController::class,
            'store',
        ])->name('authors.posts.store');

        // Author Pages
        Route::get('/authors/{author}/pages', [
            AuthorPagesController::class,
            'index',
        ])->name('authors.pages.index');
        Route::post('/authors/{author}/pages', [
            AuthorPagesController::class,
            'store',
        ])->name('authors.pages.store');

        // Author Products
        Route::get('/authors/{author}/products', [
            AuthorProductsController::class,
            'index',
        ])->name('authors.products.index');
        Route::post('/authors/{author}/products', [
            AuthorProductsController::class,
            'store',
        ])->name('authors.products.store');

        // Author Comments
        Route::get('/authors/{author}/comments', [
            AuthorCommentsController::class,
            'index',
        ])->name('authors.comments.index');
        Route::post('/authors/{author}/comments', [
            AuthorCommentsController::class,
            'store',
        ])->name('authors.comments.store');

        // Author Items
        Route::get('/authors/{author}/items', [
            AuthorItemsController::class,
            'index',
        ])->name('authors.items.index');
        Route::post('/authors/{author}/items', [
            AuthorItemsController::class,
            'store',
        ])->name('authors.items.store');

        Route::apiResource('carts', CartController::class);

        Route::apiResource('categories', CategoryController::class);

        // Category Main Category Posts
        Route::get('/categories/{category}/posts', [
            CategoryPostsController::class,
            'index',
        ])->name('categories.posts.index');
        Route::post('/categories/{category}/posts', [
            CategoryPostsController::class,
            'store',
        ])->name('categories.posts.store');

        // Category Main Category Items
        Route::get('/categories/{category}/items', [
            CategoryItemsController::class,
            'index',
        ])->name('categories.items.index');
        Route::post('/categories/{category}/items', [
            CategoryItemsController::class,
            'store',
        ])->name('categories.items.store');

        // Category Main Category Products
        Route::get('/categories/{category}/products', [
            CategoryProductsController::class,
            'index',
        ])->name('categories.products.index');
        Route::post('/categories/{category}/products', [
            CategoryProductsController::class,
            'store',
        ])->name('categories.products.store');

        // Category Main Category Pages
        Route::get('/categories/{category}/pages', [
            CategoryPagesController::class,
            'index',
        ])->name('categories.pages.index');
        Route::post('/categories/{category}/pages', [
            CategoryPagesController::class,
            'store',
        ])->name('categories.pages.store');

        Route::apiResource('comments', CommentController::class);

        Route::apiResource('continents', ContinentController::class);

        // Continent Countries
        Route::get('/continents/{continent}/countries', [
            ContinentCountriesController::class,
            'index',
        ])->name('continents.countries.index');
        Route::post('/continents/{continent}/countries', [
            ContinentCountriesController::class,
            'store',
        ])->name('continents.countries.store');

        Route::apiResource('countries', CountryController::class);

        // Country Currencies
        Route::get('/countries/{country}/currencies', [
            CountryCurrenciesController::class,
            'index',
        ])->name('countries.currencies.index');
        Route::post('/countries/{country}/currencies/{currency}', [
            CountryCurrenciesController::class,
            'store',
        ])->name('countries.currencies.store');
        Route::delete('/countries/{country}/currencies/{currency}', [
            CountryCurrenciesController::class,
            'destroy',
        ])->name('countries.currencies.destroy');

        // Country Timezones
        Route::get('/countries/{country}/timezones', [
            CountryTimezonesController::class,
            'index',
        ])->name('countries.timezones.index');
        Route::post('/countries/{country}/timezones/{timezone}', [
            CountryTimezonesController::class,
            'store',
        ])->name('countries.timezones.store');
        Route::delete('/countries/{country}/timezones/{timezone}', [
            CountryTimezonesController::class,
            'destroy',
        ])->name('countries.timezones.destroy');

        // Country Languages
        Route::get('/countries/{country}/languages', [
            CountryLanguagesController::class,
            'index',
        ])->name('countries.languages.index');
        Route::post('/countries/{country}/languages/{language}', [
            CountryLanguagesController::class,
            'store',
        ])->name('countries.languages.store');
        Route::delete('/countries/{country}/languages/{language}', [
            CountryLanguagesController::class,
            'destroy',
        ])->name('countries.languages.destroy');

        Route::apiResource('currencies', CurrencyController::class);

        // Currency Countries
        Route::get('/currencies/{currency}/countries', [
            CurrencyCountriesController::class,
            'index',
        ])->name('currencies.countries.index');
        Route::post('/currencies/{currency}/countries/{country}', [
            CurrencyCountriesController::class,
            'store',
        ])->name('currencies.countries.store');
        Route::delete('/currencies/{currency}/countries/{country}', [
            CurrencyCountriesController::class,
            'destroy',
        ])->name('currencies.countries.destroy');

        Route::apiResource('customers', CustomerController::class);

        // Customer Carts
        Route::get('/customers/{customer}/carts', [
            CustomerCartsController::class,
            'index',
        ])->name('customers.carts.index');
        Route::post('/customers/{customer}/carts', [
            CustomerCartsController::class,
            'store',
        ])->name('customers.carts.store');

        Route::apiResource('firewall-rules', FirewallRuleController::class);

        Route::apiResource('items', ItemController::class);

        // Item Has Translations
        Route::get('/items/{item}/items', [
            ItemItemsController::class,
            'index',
        ])->name('items.items.index');
        Route::post('/items/{item}/items', [
            ItemItemsController::class,
            'store',
        ])->name('items.items.store');

        Route::apiResource('languages', LanguageController::class);

        // Language Tags
        Route::get('/languages/{language}/tags', [
            LanguageTagsController::class,
            'index',
        ])->name('languages.tags.index');
        Route::post('/languages/{language}/tags', [
            LanguageTagsController::class,
            'store',
        ])->name('languages.tags.store');

        // Language Posts
        Route::get('/languages/{language}/posts', [
            LanguagePostsController::class,
            'index',
        ])->name('languages.posts.index');
        Route::post('/languages/{language}/posts', [
            LanguagePostsController::class,
            'store',
        ])->name('languages.posts.store');

        // Language Categories
        Route::get('/languages/{language}/categories', [
            LanguageCategoriesController::class,
            'index',
        ])->name('languages.categories.index');
        Route::post('/languages/{language}/categories', [
            LanguageCategoriesController::class,
            'store',
        ])->name('languages.categories.store');

        // Language Pages
        Route::get('/languages/{language}/pages', [
            LanguagePagesController::class,
            'index',
        ])->name('languages.pages.index');
        Route::post('/languages/{language}/pages', [
            LanguagePagesController::class,
            'store',
        ])->name('languages.pages.store');

        // Language Products
        Route::get('/languages/{language}/products', [
            LanguageProductsController::class,
            'index',
        ])->name('languages.products.index');
        Route::post('/languages/{language}/products', [
            LanguageProductsController::class,
            'store',
        ])->name('languages.products.store');

        // Language Items
        Route::get('/languages/{language}/items', [
            LanguageItemsController::class,
            'index',
        ])->name('languages.items.index');
        Route::post('/languages/{language}/items', [
            LanguageItemsController::class,
            'store',
        ])->name('languages.items.store');

        // Language Countries
        Route::get('/languages/{language}/countries', [
            LanguageCountriesController::class,
            'index',
        ])->name('languages.countries.index');
        Route::post('/languages/{language}/countries/{country}', [
            LanguageCountriesController::class,
            'store',
        ])->name('languages.countries.store');
        Route::delete('/languages/{language}/countries/{country}', [
            LanguageCountriesController::class,
            'destroy',
        ])->name('languages.countries.destroy');

        Route::apiResource('media', MediaController::class);

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('pages', PageController::class);

        // Page Page Templates
        Route::get('/pages/{page}/page-templates', [
            PagePageTemplatesController::class,
            'index',
        ])->name('pages.page-templates.index');
        Route::post('/pages/{page}/page-templates', [
            PagePageTemplatesController::class,
            'store',
        ])->name('pages.page-templates.store');

        // Page Has Translations
        Route::get('/pages/{page}/pages', [
            PagePagesController::class,
            'index',
        ])->name('pages.pages.index');
        Route::post('/pages/{page}/pages', [
            PagePagesController::class,
            'store',
        ])->name('pages.pages.store');

        Route::apiResource('page-templates', PageTemplateController::class);

        Route::apiResource('platforms', PlatformController::class);

        // Platform Syncs
        Route::get('/platforms/{platform}/syncs', [
            PlatformSyncsController::class,
            'index',
        ])->name('platforms.syncs.index');
        Route::post('/platforms/{platform}/syncs', [
            PlatformSyncsController::class,
            'store',
        ])->name('platforms.syncs.store');

        // Platform Syncs2
        Route::get('/platforms/{platform}/syncs', [
            PlatformSyncsController::class,
            'index',
        ])->name('platforms.syncs.index');
        Route::post('/platforms/{platform}/syncs', [
            PlatformSyncsController::class,
            'store',
        ])->name('platforms.syncs.store');

        Route::apiResource('posts', PostController::class);

        // Post Has Translations
        Route::get('/posts/{post}/posts', [
            PostPostsController::class,
            'index',
        ])->name('posts.posts.index');
        Route::post('/posts/{post}/posts', [
            PostPostsController::class,
            'store',
        ])->name('posts.posts.store');

        Route::apiResource('postal-codes', PostalCodeController::class);

        Route::apiResource('products', ProductController::class);

        // Product Has Translations
        Route::get('/products/{product}/products', [
            ProductProductsController::class,
            'index',
        ])->name('products.products.index');
        Route::post('/products/{product}/products', [
            ProductProductsController::class,
            'store',
        ])->name('products.products.store');

        Route::apiResource('revisions', RevisionController::class);

        Route::apiResource('seos', SeoController::class);

        Route::apiResource('settings', SettingController::class);

        Route::apiResource('tags', TagController::class);

        Route::apiResource('timezones', TimezoneController::class);

        // Timezone Countries
        Route::get('/timezones/{timezone}/countries', [
            TimezoneCountriesController::class,
            'index',
        ])->name('timezones.countries.index');
        Route::post('/timezones/{timezone}/countries/{country}', [
            TimezoneCountriesController::class,
            'store',
        ])->name('timezones.countries.store');
        Route::delete('/timezones/{timezone}/countries/{country}', [
            TimezoneCountriesController::class,
            'destroy',
        ])->name('timezones.countries.destroy');

        Route::apiResource('users', UserController::class);

        // User Authors
        Route::get('/users/{user}/authors', [
            UserAuthorsController::class,
            'index',
        ])->name('users.authors.index');
        Route::post('/users/{user}/authors', [
            UserAuthorsController::class,
            'store',
        ])->name('users.authors.store');
    });
