<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function (array $messages = []) {
    return view('index', ['messages' => $messages]);
})
    ->name('index');

Route::get('/hello/{name}', function (string $name) {
    return 'Hello, $name';
});

Route::get('/info', function (){
    return 'Тут будет Инфо';
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Route::get('/', AdminIndexController::class)
        ->name('index');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('orders', AdminOrderController::class);
});

Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.index');
Route::get('/category/{category}', [CategoryController::class, 'show'])
    ->where('category', '\d+')
    ->name('category.show');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');

Route::resource('orders', OrderController::class);
