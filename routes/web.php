<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\GamesController@index')->name('games.index');
Route::get('/games/{slug}', 'App\Http\Controllers\GamesController@show')->name('games.show');

