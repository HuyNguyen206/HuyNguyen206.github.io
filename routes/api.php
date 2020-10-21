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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

//    'middleware' => 'api',
//    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'JWT\APILoginController@login');
    Route::post('logout', 'JWT\APILoginController@logout');
    Route::post('refresh', 'JWT\APILoginController@refresh');
    Route::get('me', 'JWT\APILoginController@me');

});

Route::get('get-all-category','JWT\APIProductController@getAllCategory');
Route::get('get-product-by-category/{id}','JWT\APIProductController@getProductByCategory');
Route::get('get-product/{id}', 'JWT\APIProductController@getProductByID');
