<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
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
Route::group(['middleware' => 'auth'], static function () {
    Route::group(['prefix' => 'account'], static function(){
        Route::get('/', AccountController::class)->name('account');
    });
});
    //Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'check.admin'
    ], static function (){
        Route::get('/', AdminIndexController::class)
            ->name('index');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('profiles', AdminProfileController::class);
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

Route::get('/sessions', function () {

    if(session()->has('mysession')){
        dd(session()->all(), session()->get('mysession'));
    }
    session()->put('mysession', 'Test Session');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
