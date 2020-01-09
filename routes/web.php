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

Route::get('/', ['uses' => 'Home@index', 'as' => 'home']);

Route::get('/posts', ['uses' => 'Posts@index','as'=> 'posts']);

Route::post('/contact', ['uses' => 'ContactController@postInfos', 'as' => 'contact']);

