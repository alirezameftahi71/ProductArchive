<?php

use Illuminate\Http\Request;
use App\Game;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/games', 'GameController@all');
Route::get('/games/{game}', 'GameController@show');

Route::get('/genres', 'GenreController@all');
Route::get('/genres/{genre}', 'GenreController@show');
