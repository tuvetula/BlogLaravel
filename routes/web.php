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

Route::get('/', 'Home@index')->name('home1');
Route::resource('posts', 'postsController');
Route::post('/contact', 'ContactController@store')->name('contact.store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
