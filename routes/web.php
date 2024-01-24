<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInformationController;
use App\Http\Controllers\HandleController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use UniSharp\LaravelFilemanager\Lfm;


Auth::routes();
Route::post('/fileManager', function () {
    \EdSDK\FlmngrServer\FlmngrServer::flmngrRequest(
        array(
            'dirFiles' => base_path() . '/public/files'
        )
    );
});
Route::get('/runsitemap', [HandleController::class, 'sitemap']);
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     Lfm::routes();
// });
Route::get('/home', [HomeController::class, 'index']);

Route::get('/{slugFirst}', [HandleController::class, 'first'])->name('first');
Route::get('/search', [SearchController::class, 'search'])->name('search');
//Route::get('/convertproduct-wp', [App\Http\Controllers\MediaController::class, 'index']);
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');
Route::get('/', [HandleController::class, 'index'])->name('index');

Route::get('/tag/{slug}', [HandleController::class, 'handleTag'])->where('tag', '^[^/]+$')->name('frontend.tag');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/edit-permissions', [UserController::class, 'editPermissions'])->name('users.edit_permissions');
    Route::put('/users/{id}/update-permissions', [UserController::class, 'updatePermissions'])->name('users.update_permissions');
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/categories', [CategoryController::class, 'show'])->name('categories-show');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tags', TagController::class);
    Route::resource('settings', ContactInformationController::class);
    Route::resource('menus', MenuController::class);
    Route::get('/menus/{id}/setting-menu', [MenuController::class, 'settingMenu'])->name('menus.setting');
    Route::put('/menus/{id}/process-menu', [MenuController::class, 'processMenu'])->name('menus.process_menu');
    Route::resource('pages', PageController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('recruitments', RecruitmentController::class);
    Route::resource('media', MediaController::class);
});
Route::group(['prefix' => 'san-pham'], function () {
    Route::get('/{slug}', [HandleController::class, 'product'])->name('product');
});
