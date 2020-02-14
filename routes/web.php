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

use Illuminate\Support\Facades\Auth;
Route::get('/', 'HomeController@index')->name('home1');
Route::get('/contact' , 'ContactController@edit')->name('contact.edit');
Route::post('/contact', 'ContactController@store')->name('contact.store');
Route::middleware('auth')->group(function(){
    Route::resource('posts', 'PostsController');
    Route::resource('comment', 'CommentsController');
    Route::get('/account/{user}' , 'AccountController@show')->name('account.show');
    Route::get('/account/{user}/edit' , 'AccountController@edit')->name('account.edit');
    Route::get('userPosts/{user}' , 'PostsController@userPostsIndex')->name('userPosts.index');
    Route::get('/messages' , 'MessagesController@index')->name('messages.index');
    Route::get('/messages/{user}' , 'MessagesController@show')->name('messages.show')->middleware('can:talkTo,user')->middleware('auth');
    Route::post('/messages/{user}' , 'MessagesController@store')->middleware('can:talkTo,user');
    Route::get('/tokenUpdate/{user}' , 'ApiTokenController@update')->name('apiToken.update');
});
Route::middleware('ajax')->group(function(){
    Route::post('/account/{user}' , 'AccountController@update')->name('account.update');
    Route::post('/avatar/{user}' , 'AvatarController@update')->name('avatar.update');
});

Route::prefix('/backend')->name('backend.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

        //Register
        Route::get('/register' , 'AdminRegisterController@showRegistrationForm')->name('register');
        Route::post('/register' , 'AdminRegisterController@register');

    });
    Route::middleware('isAdmin')->group(function(){
        Route::get('/home','AdminHomeController@index')->name('home');
        Route::resource('admins', 'AdminsController');
        Route::resource('users', 'UsersController');

    });
});
Auth::routes();

