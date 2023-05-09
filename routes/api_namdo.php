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


Route::group(['namespace' => 'Api\Frontend','prefix' => 'client','as'=>'api.'],function(){
    Route::post('/login','Auth\LoginController@login');
    Route::post('/register','Auth\RegisterController@register');
    Route::get('/menu-category','MenuCategoryController@index');
    Route::get('/category','CategoryController@index');
    Route::get('/search','ProductController@getSearch');
    Route::get('/blog','BlogController@getIndex');
    Route::get('/blog/search','BlogController@getSearch');
    Route::get('/blog/{category}','BlogController@getCategory');
    Route::get('/blog/{category}/{id}','BlogController@getItem');
    Route::get('/category/{id}','ProductController@getCategory');
    Route::get('/product/{category}/{id}','ProductController@getItem');
    Route::group(['middleware' => 'auth_api','api'],function(){
        Route::post('/order','OrderController@postOrder');
        Route::get('/order','OrderController@getOrder');
        Route::get('/profile','UserController@getInfo');
        Route::post('/profile','UserController@postProfile');

    });
});


//api
Route::group(['namespace' => 'Api\Backend','prefix' => 'admin','as'=>'api.'],function(){
    Route::post('/login','Auth\LoginController@login');

});


