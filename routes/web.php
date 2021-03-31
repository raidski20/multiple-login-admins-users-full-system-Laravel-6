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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'Admin\AdminController@index')->name('admin')->middleware('admin.verified');


Route::group(['prefix'=> 'admin', 'namespace'=> 'Admin\Auth'], function () {

    Route::group(['prefix'=>'password'], function () {

        Route::get('confirm', 'ConfirmPasswordController@showConfirmForm')->name('admin.password.view');
        Route::post('confirm', 'ConfirmPasswordController@confirm')->name('admin.password.confirm');
        Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('reset', 'ForgotPasswordController@showAdminLinkRequestForm')->name('admin.password.request');
        Route::post('reset', 'ResetPasswordController@reset')->name('admin.password.update');
        Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    });

    Route::group(['prefix'=>'email'], function () {

        Route::post('resend', 'VerificationController@resend')->name('admin.verification.resend');
        Route::get('verify', 'VerificationController@show')->name('admin.verification.notice');
        Route::get('verify/{id}/{hash}', 'VerificationController@verify')->name('admin.verification.verify');
    });

});


Route::get('/admin-login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin-login', 'Admin\Auth\LoginController@login')->name('admin.login.sub');
Route::post('admin-logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');




