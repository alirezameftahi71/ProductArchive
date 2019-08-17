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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/games', 'HomeController@store')->name('store');
Route::put('/games/{game}', 'HomeController@update')->name('update');