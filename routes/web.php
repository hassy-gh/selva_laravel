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
})->name('top');

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
        // sell
        Route::get('/sell', 'SellController@showSellForm')->name('sell.show');
        Route::post('/sell', 'SellController@sellProduct')->name('sell.sell');
        Route::get('/sell/confirm', 'SellController@showConfirmForm')->name('sell.show_confirm');
        Route::post('/sell/confirm', 'SellController@confirm')->name('sell.confirm');
        Route::post('/image-upload', 'SellController@imageUpload')->name('sell.image_upload');
        // review
        Route::get('/products/{product}/review', 'ReviewController@showReviewForm')->name('review.form');
        Route::post('/products/{product}/review', 'ReviewController@reviewPost')->name('review.post');
        Route::get('/products/{product}/review/confirm', 'ReviewController@showConfirmForm')->name('review.confirm');
        Route::post('/products/{product}/review/confirm', 'ReviewController@confirm')->name('review.register');
        Route::get('/products/{product}/review/complete', 'ReviewController@complete')->name('review.complete');
        // mypage
        Route::get('/mypage', 'ProfileController@showProfile')->name('mypage.profile');
        Route::get('/mypage/edit', 'ProfileController@showProfileEditForm')->name('mypage.show_profile_edit');
        Route::post('/mypage/edit', 'ProfileController@profileEdit')->name('mypage.profile_edit');
        Route::get('/mypage/edit/confirm', 'ProfileController@showConfirmForm')->name('mypage.profile_edit_confirm');
        Route::post('/mypage/edit/confirm', 'ProfileController@profileUpdate')->name('mypage.profile_update');
        Route::get('/mypage/password-edit', 'PasswordUpdateController@showPasswordEditForm')->name('mypage.show_password_edit');
        Route::post('/mypage/password-edit', 'PasswordUpdateController@passwordUpdate')->name('mypage.password_update');
        Route::get('/withdrawal_confirm', 'ProfileController@showWithdrawalConfirm')->name('mypage.withdrawal_confirm');
        Route::post('/withdrawal', 'ProfileController@withdrawal')->name('mypage.withdrawal');
        Route::get('/mypage/email-edit', 'EmailUpdateController@showEmailEditForm')->name('mypage.show_email_edit');
        Route::post('/mypage/email-edit', 'EmailUpdateController@emailEdit')->name('mypage.email_edit');
        Route::get('/mypage/email-edit/auth', 'EmailUpdateController@showAuthForm')->name('mypage.show_auth');
        Route::post('/mypage/email-edit/auth', 'EmailUpdateController@emailUpdate')->name('mypage.email_update');
    });

// sell
Route::post('/category', 'SellController@category')->name('sell.category');
Route::get('/products', 'ProductsController@showProducts')->name('products.index');
Route::get('/products/{product}', 'ProductsController@showProductDetail')->name('products.detail');

// review
Route::get('/products/{product}/reviews', 'ReviewController@showReviews')->name('review.reviews');
