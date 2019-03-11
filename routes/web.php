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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware(['web'])->group(function (){

    Route::get('/test','BlogController@test');

    Route::prefix('admin')->group(function (){
        Route::get('/','DashboardController@index')->name('dashboard');

        Route::get('products/img/{id}','ProductController@deleteImage');
        Route::resource('settings','SettingController')->only(['index','update']);
        Route::resource('sliders','SliderController')->only(['index','store','destroy','create']);
        Route::get('api/categories/delete/{id}','CategoryController@destroy');
        Route::get('api/products/delete/{id}','ProductController@destroy');
        Route::resources([
            'categories'=> 'CategoryController',
            'products'=>'ProductController'
        ]);
        Route::get('/api/option/delete/{id}',[
            'uses'=>'OptionController@destroy'
        ]);
        Route::get('/api/product/deleteExtraImage/{id}/{url}',[
            'uses'=>'ProductController@deleteExtra'
        ]);
        Auth::routes();
    });

    Route::get('categories/{category}/products','CategoryController@CategoryProducts')->name('category.products');
    Route::resource('categories','CategoryController')->only(['show']);
    Route::resource('products','ProductController')->only(['show']);
    Route::get('/home' ,'BlogController');
    Route::get('/' ,'BlogController')->name('home');

    Route::post('sendMail',[
        'uses'=>'MailController@sendMail',
        'as'=> 'mail.send'
    ]);

});




//Route::get('/home', 'HomeController@index')->name('home');
