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

//    Route::get('/test','BlogController@test');
    Route::get('/test','HomeController');
    Route::prefix('admin')->group(function (){
        Route::get('/','DashboardController@index')->name('dashboard');
        Route::resource('settings','SettingController')->only(['index','update']);
        Route::resource('sliders','SliderController')->only(['index','store','destroy','create']);
        Route::resources([
            'categories'=> 'CategoryController',
            'products'=>'ProductController'
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
