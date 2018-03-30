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

Route::get('/', 'PageController@welcome')->name('welcome');

Route::get('wines/all', 'WineController@index')->name('wines.index');
Route::get('wine/show/{wine}', 'WineController@show')->name('wine.show');

Route::get('user/@{user}', 'ProfileController@show')->name('user.profile.show');