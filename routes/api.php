<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'AuthController@login')->name('login');
Route::get('/login/error', function() {
    return response()->json(['status' => false, 'message' => "You need to login first"], 401);
})->name('login_error');
Route::post('/register', 'AuthController@register')->name('register');


Route::get('/news', 'NewsController@index');
Route::get('/news/{id}', 'NewsController@show');
Route::get('/news/search/results', 'NewsController@search');


Route::get('/videos', 'VideosController@index');
Route::get('/videos/{id}', 'VideosController@show');
Route::get('/videos/search/results', 'VideosController@search');

Route::get('/pdfs', 'PDFController@index');

Route::post('/calendars', 'CalendarController@index');

Route::get('/players', 'PlayersController@index');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile', 'UsersController@profile');
    Route::post('/transportation', 'TransportationController@index');
});
