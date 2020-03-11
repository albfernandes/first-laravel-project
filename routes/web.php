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

Route::get('/', function () {
    return view('welcome');
});

Route::get('series', 'SeriesController@index');
Route::get('series/criar', 'SeriesController@create');
Route::post('series/criar', 'SeriesController@store');
Route::delete('series/{id}', 'SeriesController@destroy');
Route::post('series/{id}', 'SeriesController@editarNome');

Route::get('series/{seriesId}/temporadas', 'TemporadasController@index');
