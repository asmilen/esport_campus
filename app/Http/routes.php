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

Route::group(['middlewareGroups' => 'web'], function () {

	#Frontend Route.

    Route::get('dang-nhap', 'Frontend\AuthController@redirectToLogin');   
    Route::get('oauth/callback', 'Frontend\AuthController@callback');   
    Route::get('thoat', 'Frontend\AuthController@redirectToLogout');
    Route::get('/','Frontend\MainController@index');
    Route::get('/tham-gia','Frontend\MainController@test');

    #Admin Routes.
    Route::get('admin', 'Backend\MainController@index');
});
