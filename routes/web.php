<?php

use Illuminate\Support\Facades\Route;

Route::get('/show', function () {
    return view('show');
});

Route::get('/', 'App\Http\Controllers\GamesController@index')->name('games.index');
