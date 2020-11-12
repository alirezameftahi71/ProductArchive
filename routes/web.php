<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Page routes
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/create', 'HomeController@create');
Route::get('/edit/{id}', 'HomeController@edit');
Route::get('/gridview', 'HomeController@gridview');
Route::get('/profile/{user}', 'HomeController@dashboard');

// Auth group APIs
Route::get('/api/games', 'GameController@all');
Route::get('/api/games/{game}', 'GameController@show');
Route::post('/api/games', 'GameController@store');
Route::post('/api/games/addToList', 'UserListController@addItem');
Route::post('/api/games/{game}', 'GameController@update');
Route::post('/api/games/heart/{game}', 'UserListController@heartItem');
Route::delete('/api/games/{game}', 'GameController@destroy');

Route::get('/api/lists', 'UserListController@all');
Route::get('/api/lists/{list}', 'UserListController@show');
Route::post('/api/lists', 'UserListController@store');
Route::post('/api/lists/{list}', 'UserListController@update');
Route::delete('/api/lists/{list}', 'UserListController@destroy');


Route::get('/api/genres', 'GenreController@all');
Route::get('/api/genres/{genre}', 'GenreController@show');

Route::get('/api/platforms', 'PlatformController@all');
Route::get('/api/platforms/{platform}', 'PlatformController@show');

Route::get('/api/publishers', 'PublisherController@all');
Route::get('/api/publishers/{publisher}', 'PublisherController@show');

Route::get('/api/users', 'UserController@all');
Route::get('/api/users/{user}', 'UserController@show');
Route::get('/api/user/lists', 'UserListController@getUserListsForCurrentUser');

Auth::routes();
