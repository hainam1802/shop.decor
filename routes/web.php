<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin','namespace' => 'Admin'], function() {
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('dashboard', 'DashboardController');
        // route user
        Route::group(['namespace' => 'User'], function () {
            Route::resource('user', 'UserController');
            Route::resource('active-log', 'ActiveLogController');
            Route::get('log-user/{id}','ActiveLogController@LogUser');
            Route::get('data/user','UserController@anyData')->name('user.datatable');
            Route::get('profile','ProfileController@getProfile')->name('user.profile');
            Route::get('profile-password','ProfileController@getPassword')->name('user.password');
            Route::post('profile','ProfileController@postProfile')->name('user.post-profile');
            Route::get('set-permission-user/{id}','UserController@getSetPermission')->name('user.set-permisson');
            Route::post('set-permission-user/{id}','UserController@postSetPermission')->name('user.post-permisson');
            Route::post('log-user/export/{id}', 'ActiveLogController@export');
        });

        // route permission
        Route::group(['namespace' => 'Permission'], function () {
            Route::resource('permission', 'PermissionController');
            Route::get('data/permission','PermissionController@anyData')->name('permission.datatable');
        }); 

        Route::group(['namespace' => 'Article'], function () {

            Route::get('module-category/{module}','GroupsController@index');
            Route::get('module-category/{module}/create','GroupsController@create');
            Route::post('module-category/{module}','GroupsController@store');
            Route::get('module-category/{module}/edit/{id}','GroupsController@edit');
            Route::post('module-category/{module}/edit/{id}','GroupsController@update');
            Route::post('module-category/{module}/update-order','GroupsController@UpdateOrder');
            Route::post('module-category/{module}/{id}','GroupsController@destroy');
            


            Route::get('module-item/{module}','ItemsController@index');
            Route::get('module-item/{module}/create','ItemsController@create');
            Route::post('module-item/{module}','ItemsController@store');
            Route::get('module-item/{module}/edit/{id}','ItemsController@edit');
            Route::post('module-item/{module}/edit/{id}','ItemsController@update');
            Route::post('module-item/{module}/{id}','ItemsController@destroy');
        });
        Route::group(['namespace' => 'Language'], function () {
            Route::resource('language-nation','LanguageNationController');
            Route::resource('language-key','LanguageKeyController');
            Route::resource('language-mapping','LanguageMappingController');
            Route::get('language/{locale}','RequestLanguageController@index')->name('locale.index');
            Route::post('language/export/', 'LanguageMappingController@export')->name('language.export');
            Route::post('language/import/', 'LanguageMappingController@import')->name('language.import');
            Route::post('language-render/','LanguageMappingController@render')->name('language.render');
        });

        Route::group(['namespace' => 'Setting'], function () {
            Route::resource('setting-module', 'ModuleController');
            Route::resource('color-product', 'ColorProductController');
            Route::resource('setting', 'SettingController');
            Route::get('clear-cache','ModuleController@clearCache')->name('clear-cache');
            Route::resource('advertisement','AdvertisementController');
        });
        Route::group(['namespace' => 'Customer'], function () {
            Route::resource('feedback','FeedbackController');
            Route::resource('order','ItemOrderController');
            Route::resource('order-done','ItemOrderDoneController');
            Route::get('order/update-order/{id}','ItemOrderController@UpdateOrder');
            Route::post('order/export', 'ItemOrderController@export')->name('order.export');
        });
    });
});

// route frontend

Route::group(['namespace' => 'Frontend'], function() {
    Route::get('/','IndexController@getIndex');
    Route::post('search','IndexController@search')->name('search');
    Route::get('san-pham/{slug}','IndexController@details');
    Route::get('details/{id}','IndexController@details_id');
    Route::get('/san-pham','IndexController@product');
    Route::get('/danh-muc/{slug}','IndexController@category');
    Route::get('/chinh-sach','IndexController@policy');
    Route::group(['prefix'=>'cart'],function (){
        Route::post('add/{id}','CartController@AddCart');
        Route::get('show','CartController@getShow');
        Route::post('delete/{id}','CartController@getDelete');
        Route::post('update','CartController@Update');
        Route::get('cart-done','CartController@getCheckout');
        Route::post('cart-done','CartController@postCheckout');
        Route::get('succsess','CartController@getSusscess');
    });
    Route::resource('blog','BlogController');
    Route::get('blog/bai-viet/{slug}','BlogController@details');
    Route::get('lien-he','IndexController@contact');
    Route::post('lien-he','IndexController@mailContact');
});