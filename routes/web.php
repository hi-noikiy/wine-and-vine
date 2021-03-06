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

Route::get('wines/index', 'WineController@index')->name('wines.index');
Route::get('wines/index?q={query}', 'WineController@index')->name('wines.index.query');
Route::get('wine/show/{wine}', 'WineController@show')->name('wine.show');

Route::get('wineries/index', 'WineryController@index')->name('wineries.index');
Route::get('wine/show/{winery}', 'WineryController@show')->name('winery.show');

Route::get('users/index', 'UserController@index')->name('users.index');
Route::get('user/@{user}', 'ProfileController@show')->name('user.profile.show');
