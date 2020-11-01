<?php

use Illuminate\Support\Facades\Route;

// Stateless APIs
Route::get('/games', 'GameController@all');
Route::get('/games/{game}', 'GameController@show');

Route::get('/genres', 'GenreController@all');
Route::get('/genres/{genre}', 'GenreController@show');

Route::get('/platforms', 'PlatformController@all');
Route::get('/platforms/{platform}', 'PlatformController@show');

Route::get('/publishers', 'PublisherController@all');
Route::get('/publishers/{publisher}', 'PublisherController@show');

Route::get('/lists', 'UserListController@all');
Route::get('/lists/{list}', 'UserListController@show');

Route::get('/users', 'UserController@all');
Route::get('/users/{user}', 'UserController@show');
