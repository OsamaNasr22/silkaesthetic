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

Route::get('products/{category_id}','BlogController@productsByCategory')->name('products.category');
Route::get('products/','BlogController@allProducts')->name('products.all');
Route::get('categories/','BlogController@categories')->name('categories.all');



