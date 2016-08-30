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
    Route::post('tai-khoan', 'Frontend\MainController@updateInfoAccount');

    #Admin Routes.
    Route::get('quan-li/them-truong', 'Backend\UploadFileController@addUniversity');
    Route::post('quan-li/them-truong', 'Backend\UploadFileController@postAddFileUniversity');

    Route::get('quan-li/them-cau-hoi', 'Backend\UploadFileController@addQuestion');
    Route::post('quan-li/them-cau-hoi', 'Backend\UploadFileController@postAddFileQuestion');

    Route::get('quan-li/them-dap-an', 'Backend\UploadFileController@addAnswer');
    Route::post('quan-li/them-dap-an', 'Backend\UploadFileController@postAddFileAnswer');

    
    Route::get('/quan-li', 'Backend\MainController@index');
    Route::get('oauth/google/callback', 'Backend\AuthController@handleGoogleCallback');
    Route::get('/quan-li/login', 'Backend\AuthController@redirectToGoogle');
    Route::get('/quan-li/logout', 'Backend\AuthController@logout');
});
