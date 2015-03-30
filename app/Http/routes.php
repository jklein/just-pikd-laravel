<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@handleGet');
Route::get('/products/{sku}/{slug?}', 'ProductController@handleGet');

Route::get('home', 'HomeController@index');

Route::post('search', 'SearchController@handleSearch');

Route::group(['middleware' => 'auth'], function() {

    Route::get('cart', 'CartController@handleGet');
    Route::post('cart', 'CartController@handlePost');

    Route::post('checkout', 'CartController@checkout');

    Route::get('account', 'AccountController@handleGet');
    Route::post('account', 'AccountController@handlePost');

    Route::resource(
        'account/orders',
        'OrderController',
        ['only' => ['index', 'show']]
    );

    Route::resource(
        'account/referrals',
        'ReferralController',
        ['only' => ['index', 'store']]
    );

    Route::resource(
        'favorites',
        'FavoriteController',
        ['only' => ['index', 'store', 'destroy']]
    );
});

Route::get('util', 'UtilController@handleGet');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
