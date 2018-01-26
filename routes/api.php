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

//Arta
Route::post('/home', 'ArtaController@home');
Route::post('/arta/add', 'ArtaController@add');
Route::post('/arta/search', 'ArtaController@search');
Route::post('/arta/get', 'ArtaController@get');

//Cat
Route::post('/cat/add', 'CatagoryController@add');
Route::post('/cat/all', 'CatagoryController@all');
Route::post('/cat/get', 'CatagoryController@get');

//User
Route::post('/user/login', 'UserController@login');
Route::post('/user/logout', 'UserController@logout');
Route::post('/user/register', 'UserController@register');
Route::post('/user/update', 'UserController@update');

//Tag
Route::post('/tag/get', 'TagController@get');

//Like
Route::post('/like/add', 'LikeController@add');
Route::post('/like/is_liked', 'LikeController@is_liked');