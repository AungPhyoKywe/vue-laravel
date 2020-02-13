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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'SpaController@getData');
Route::get('/edit/{id}','SpaController@edit');
Route::post('/posts/create', 'SpaController@store');
Route::delete('/posts/{id}','SpaController@destroy');
