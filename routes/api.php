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
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');



Route::apiResource('/article', 'Api\ArticleController');
// Route::get('/articles', 'Api\ArticleController@index');

// //show single article
// Route::get('article/{id}', 'Api\ArticleController@show');

// //create article
// Route::post('article', 'Api\ArticleController@store');

// //update article
// Route::put('article', 'Api\ArticleController@update');

// //delete article
// Route::delete('article/{id}', 'Api\ArticleController@destroy');

// Route::apiResource('/profile', 'Api\ProfileController');


Route::get('/profiles', 'Api\ProfileController@index');

Route::post('profile', 'Api\ProfileController@store');

Route::get('profile/{id}', 'Api\ProfileController@show');

Route::put('profile/{profile}', 'Api\ProfileController@update');
