<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {

    #region thao tác với giỏ hàng
    Route::prefix('cart')->group(function () {
        Route::get('/', 'CardController@index');
        Route::get('/add_card/{id}', 'CardController@cardAdd');
        Route::get('/update/{id}', 'CardController@cartUpdate');
        Route::get('/delete/{id}', 'CardController@cartDelete');
        /** đặt hàng */
        Route::get('/order', 'CardController@cartOrder');
    });
    #endregion
});
