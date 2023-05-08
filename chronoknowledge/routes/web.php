<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostFavoriteController;
use App\Http\Controllers\Auth\PasswordResetController;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'index'])->name('register.index');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::get('/forget-password', [PasswordResetController::class, 'index'])->name('password.index');
    Route::post('/send-email', [PasswordResetController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'sendResetLink'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');
    Route::get('/google-login', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [LoginController::class, 'loginWithGoogle'])->name('login.google-callback');
    Route::get('/facebook-login', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('/auth/facebook/callback', [LoginController::class, 'loginWithFacebook'])->name('login.facebook-callback');
    Route::get('/', [HomeController::class, 'index'])->name('index');
});

//public pages
Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('posts.show');
Route::get('/privacy-policy', [HomeController::class, 'public'])->name('privacy-policy');
Route::get('/team', [HomeController::class, 'public'])->name('team');
Route::get('/faqs', [HomeController::class, 'public'])->name('faqs');
Route::get('/about', [HomeController::class, 'public'])->name('about');
Route::get('/guides', [HomeController::class, 'public'])->name('guides');
Route::get('/code', [HomeController::class, 'public'])->name('code');
Route::get('/terms', [HomeController::class, 'public'])->name('terms');
Route::post('/', [HomeController::class, 'index'])->name('posts.search');

//posts
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/listing', [HomeController::class, 'listing'])->name('listing');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::group(['prefix' => '/user'], function () {
        //posts
        Route::group(['prefix' => '/posts'], function () {
            // Route::get('/{post}/show', [PostController::class, 'show'])->name('posts.show');
            Route::get('/create', [PostController::class, 'create'])->name('posts.create');
            Route::post('/store', [PostController::class, 'store'])->name('posts.store');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
            Route::post('/{post}/update', [PostController::class, 'update'])->name('posts.update');
            Route::delete('/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
        });

        //comments
        Route::group(['prefix' => '/comments'], function () {
            Route::post('/store', [PostCommentController::class, 'store'])->name('comments.store');
            Route::post('/{comment}/update', [PostCommentController::class, 'update'])->name('comments.update');
            Route::delete('/{comment}/destroy', [PostCommentController::class, 'destroy'])->name('comments.destroy');
        });

        //likes
        Route::group(['prefix' => '/likes'], function () {
            Route::post('/store', [PostLikeController::class, 'store'])->name('likes.store');
            Route::delete('/destroy', [PostLikeController::class, 'destroy'])->name('likes.destroy');
        });

        //favorites
        Route::group(['prefix' => '/favorites'], function () {
            Route::get('/', [PostFavoriteController::class, 'index'])->name('favorites.index');
            Route::post('/store', [PostFavoriteController::class, 'store'])->name('favorites.store');
            Route::delete('/destroy', [PostFavoriteController::class, 'destroy'])->name('favorites.destroy');
        });
    });

    Route::group(['prefix' => '/admin'], function () {
        Route::get('/', [HomeController::class, 'admin'])->name('admin.dashboard');
        Route::post('/search', [HomeController::class, 'admin'])->name('admin.search');
        Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');
        Route::Post('/posts/edit/{post}', [PostController::class, 'updateViaAdmin'])->name('admin.posts.edit');
        //tags
        Route::group(['prefix' => '/tags'], function () {
            Route::get('/', [TagController::class, 'index'])->name('admin.tags.index');
            Route::get('/create', [TagController::class, 'create'])->name('admin.tags.create');
            Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
            Route::post('/store', [TagController::class, 'store'])->name('admin.tags.store');
            Route::post('/{tag}/update', [TagController::class, 'update'])->name('admin.tags.update');
            Route::delete('/{tag}/delete', [TagController::class, 'destroy'])->name('admin.tags.destroy');
        });

        //categories
        Route::group(['prefix' => '/categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::post('/{category}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        });
    });
});
