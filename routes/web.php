<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Page routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create-edit');
Route::get('/edit/{id}', 'HomeController@edit')->name('create-edit');
Route::get('/gridview', 'HomeController@gridview')->name('gridview');
Route::get('/profile/{user}', 'HomeController@dashboard')->name('dashboard');

// Auth group APIs
Route::post('/api/games', 'GameController@store');
Route::post('/api/games/{game}', 'GameController@update');
Route::delete('/api/games/{game}', 'GameController@destroy');
Route::post('/api/games/toggleChecked/{game}', 'GameController@toggleChecked');

Route::post('/api/lists', 'UserListController@store');
Route::post('/api/lists/{list}', 'UserListController@update');
Route::delete('/api/lists/{list}', 'UserListController@destroy');

Auth::routes();
