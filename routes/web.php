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

Route::get('/', 'IndexController@home')->name('home');
Route::resource('user','UserController');
Route::resource('blog','BlogController');
Route::get('logout','LoginController@logout')->name('logout');
Route::get('login','LoginController@login')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('confirmEmailToken/{token}','UserController@confirmEmailToken')->name('confirmEmailToken');
Route::get('follow/{user}','UserController@follow')->name('user.follow');

Route::get('follower/{user}','FollowController@follower')->name('follower');
Route::get('following/{user}','FollowController@following')->name('following');

Route::get('findPasswordEmail','PasswordController@email')->name('findPasswordEmail');
Route::post('findPasswordSend','PasswordController@send')->name('findPasswordSend');
Route::get('findPasswordEdit/{token}','PasswordController@edit')->name('findPasswordEdit');
Route::post('findPasswordUpdate','PasswordController@update')->name('findPasswordUpdate');
