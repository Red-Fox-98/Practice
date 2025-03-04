<?php

use Illuminate\Support\Facades\Route;
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

Route::group(['prefix' => 'digging_deeper',], function (){
    Route::get('collections', 'App\Http\Controllers\DiggingDeeperController@collections')
        ->name('digging_deeper.collections');
    Route::get('process-video', 'App\Http\Controllers\DiggingDeeperController@processVideo')
        ->name('digging_deeper.processVideo');
    Route::get('prepare-catalog', 'App\Http\Controllers\DiggingDeeperController@prepareCatalog')
        ->name('digging_deeper.prepareCatalog');
        });

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'App\Http\Controllers\Blog\PostController')->names('blog.posts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Админка блога
$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function () {
    //BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store',];
    Route::resource('categories', 'App\Http\Controllers\Blog\Admin\CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');
    //BlogPost
    Route::resource('posts', 'App\Http\Controllers\Blog\Admin\PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});
