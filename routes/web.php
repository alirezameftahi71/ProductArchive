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
Route::get('/api/games', 'GameController@all');
Route::get('/api/games/{game}', 'GameController@show');
Route::post('/api/games', 'GameController@store');
Route::post('/api/games/{game}', 'GameController@update');
Route::delete('/api/games/{game}', 'GameController@destroy');

Route::post('/api/games/heart/{game}', 'UserListController@markFavorite');

Route::post('/api/lists', 'UserListController@store');
Route::post('/api/lists/{list}', 'UserListController@update');
Route::delete('/api/lists/{list}', 'UserListController@destroy');



Route::get('/api/genres', 'GenreController@all');
Route::get('/api/genres/{genre}', 'GenreController@show');

Route::get('/api/platforms', 'PlatformController@all');
Route::get('/api/platforms/{platform}', 'PlatformController@show');

Route::get('/api/publishers', 'PublisherController@all');
Route::get('/api/publishers/{publisher}', 'PublisherController@show');

Route::get('/api/lists', 'UserListController@all');
Route::get('/api/lists/{list}', 'UserListController@show');

Route::get('/api/users', 'UserController@all');
Route::get('/api/users/{user}', 'UserController@show');
Auth::routes();
