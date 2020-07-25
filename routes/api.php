<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::get('blogs', 'BlogController@index');
Route::get('blogs/{blog}', 'BlogController@show');

Route::group(['middleware' => 'jwt.verify'], function (){
    Route::post('blogs', 'BlogController@store');
    Route::put('blogs/{blog}', 'BlogController@update');
    Route::delete('blogs/{blog}', 'BlogController@destroy');
});
