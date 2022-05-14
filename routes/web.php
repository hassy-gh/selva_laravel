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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('member.register_show');
Route::post('/register', 'Auth\RegisterController@post')->name('member.register_post');
Route::get('/register/confirm', 'Auth\RegisterController@confirm')->name('member.register_confirm');
Route::post('/register/confirm', 'Auth\RegisterController@register')->name('member.register_register');
Route::get('/register/complete', 'Auth\RegisterController@complete')->name('member.register_complete');
Route::get('/password/send', 'Auth\ForgotPasswordController@showSendEmail')->name('password.send');

// Route::get('/home', 'HomeController@index')->name('home');

// sell
Route::post('/category', 'SellController@category')->name('sell.category');
Route::get('/products', 'ProductsController@showProducts')->name('products.index');
Route::get('/products/{product}', 'ProductsController@showProductDetail')->name('products.detail');

// review
Route::get('/products/{product}/reviews', 'ReviewController@showReviews')->name('review.reviews');

Route::group(['middleware' => 'auth:member'], function () {
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
    // profile_edit
    Route::get('/mypage/edit', 'ProfileController@showProfileEditForm')->name('mypage.show_profile_edit');
    Route::post('/mypage/edit', 'ProfileController@profileEdit')->name('mypage.profile_edit');
    Route::get('/mypage/edit/confirm', 'ProfileController@showConfirmForm')->name('mypage.profile_edit_confirm');
    Route::post('/mypage/edit/confirm', 'ProfileController@profileUpdate')->name('mypage.profile_update');
    // password_edit
    Route::get('/mypage/password-edit', 'PasswordUpdateController@showPasswordEditForm')->name('mypage.show_password_edit');
    Route::post('/mypage/password-edit', 'PasswordUpdateController@passwordUpdate')->name('mypage.password_update');
    // withdrawal
    Route::get('/withdrawal_confirm', 'ProfileController@showWithdrawalConfirm')->name('mypage.withdrawal_confirm');
    Route::post('/withdrawal', 'ProfileController@withdrawal')->name('mypage.withdrawal');
    // email_edit
    Route::get('/mypage/email-edit', 'EmailUpdateController@showEmailEditForm')->name('mypage.show_email_edit');
    Route::post('/mypage/email-edit', 'EmailUpdateController@emailEdit')->name('mypage.email_edit');
    Route::get('/mypage/email-edit/auth', 'EmailUpdateController@showAuthForm')->name('mypage.show_auth');
    Route::post('/mypage/email-edit/auth', 'EmailUpdateController@emailUpdate')->name('mypage.email_update');
    // member_reviews
    Route::get('/mypage/reviews', 'ProfileController@showReviews')->name('mypage.reviews');
    // review_edit
    Route::get('/products/{product}/reviews/{review}/edit', 'ReviewController@showReviewEditForm')->name('review.show_edit');
    Route::post('/products/{product}/reviews/{review}/edit', 'ReviewController@reviewEdit')->name('review.edit');
    Route::get('/products/{product}/reviews/{review}/confirm', 'ReviewController@showReviewEditConfirmForm')->name('review.show_edit_confirm');
    Route::post('/products/{product}/reviews/{review}/update', 'ReviewController@reviewUpdate')->name('review.update');
    // review_delete
    Route::get('/products/{product}/reviews/{review}/delete', 'ReviewController@showReviewDeleteForm')->name('review.show_delete');
    Route::post('/products/{product}/reviews/{review}/delete', 'ReviewController@reviewDelete')->name('review.delete');
});

// administer
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:administer'], function () {
    // top
    Route::get('/', function () {
        return view('admin.welcome');
    })->name('admin.top');
    // logout
    Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    // members
    Route::get('/members', 'Admin\MembersController@showMembers')->name('admin.members.members');
    // member_register
    Route::get('/members/register', 'Admin\MembersController@showRegisterForm')->name('admin.members.show_register');
    Route::post('/members/register', 'Admin\MembersController@post')->name('admin.members.post');
    Route::get('/members/register/confirm', 'Admin\MembersController@showConfirmForm')->name('admin.members.show_register_confirm');
    Route::post('/members/register/register', 'Admin\MembersController@register')->name('admin.members.register');
    // member_edit
    Route::get('/members/{member}/edit', 'Admin\MembersController@showEditForm')->name('admin.members.show_edit');
    Route::post('/members/{member}/edit', 'Admin\MembersController@edit')->name('admin.members.edit');
    Route::get('/members/{member}/edit/confirm', 'Admin\MembersController@showEditConfirmForm')->name('admin.members.show_edit_confirm');
    Route::post('/members/{member}/edit/update', 'Admin\MembersController@update')->name('admin.members.update');
    // member_detail
    Route::get('/members/{member}/detail', 'Admin\MembersController@showDetail')->name('admin.members.detail');
    Route::post('/members/{member}/delete', 'Admin\MembersController@delete')->name('admin.members.delete');
});
