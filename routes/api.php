<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\RevisionController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthorPostsController;
use App\Http\Controllers\Api\AuthorPagesController;
use App\Http\Controllers\Api\AuthorItemsController;
use App\Http\Controllers\Api\UserAuthorsController;
use App\Http\Controllers\Api\LanguageTagsController;
use App\Http\Controllers\Api\LanguagePostsController;
use App\Http\Controllers\Api\LanguagePagesController;
use App\Http\Controllers\Api\LanguageItemsController;
use App\Http\Controllers\Api\CategoryPostsController;
use App\Http\Controllers\Api\CategoryItemsController;
use App\Http\Controllers\Api\CategoryPagesController;
use App\Http\Controllers\Api\AuthorProductsController;
use App\Http\Controllers\Api\AuthorCommentsController;
use App\Http\Controllers\Api\UserBypassTokensController;
use App\Http\Controllers\Api\LanguageProductsController;
use App\Http\Controllers\Api\CategoryProductsController;
use App\Http\Controllers\Api\LanguageCountriesController;
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
        Route::apiResource('tags', TagController::class);

        Route::apiResource('revisions', RevisionController::class);

        Route::apiResource('posts', PostController::class);

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

        // Author Items
        Route::get('/authors/{author}/items', [
            AuthorItemsController::class,
            'index',
        ])->name('authors.items.index');
        Route::post('/authors/{author}/items', [
            AuthorItemsController::class,
            'store',
        ])->name('authors.items.store');

        // Author Comments
        Route::get('/authors/{author}/comments', [
            AuthorCommentsController::class,
            'index',
        ])->name('authors.comments.index');
        Route::post('/authors/{author}/comments', [
            AuthorCommentsController::class,
            'store',
        ])->name('authors.comments.store');

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

        // User Bypass Tokens
        Route::get('/users/{user}/bypass-tokens', [
            UserBypassTokensController::class,
            'index',
        ])->name('users.bypass-tokens.index');
        Route::post('/users/{user}/bypass-tokens', [
            UserBypassTokensController::class,
            'store',
        ])->name('users.bypass-tokens.store');

        Route::apiResource('comments', CommentController::class);

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
    });
