<?php

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

use App\Http\Controllers\SellController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('member.register_show');
Route::post('/register', 'Auth\RegisterController@post')->name('member.register_post');
Route::get('/register/confirm', 'Auth\RegisterController@confirm')->name('member.register_confirm');
Route::post('/register/confirm', 'Auth\RegisterController@register')->name('member.register_register');
Route::get('/register/complete', 'Auth\RegisterController@complete')->name('member.register_complete');
Route::get('/password/send', 'Auth\ForgotPasswordController@showSendEmail')->name('password.send');

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')
    ->group(function () {
        Route::get('/sell', 'SellController@showSellForm')->name('sell.show');
        Route::post('/sell', 'SellController@sellProduct')->name('sell.sell');
        Route::get('/sell/confirm', 'SellController@showConfirmForm')->name('sell.show_confirm');
        Route::post('/sell/confirm', 'SellController@confirm')->name('sell.confirm');
        Route::post('/category', 'SellController@category')->name('sell.category');
        Route::post('/image-upload', 'SellController@imageUpload')->name('sell.image_upload');
    });
