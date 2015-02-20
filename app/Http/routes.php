<?php

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

// Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@getContact']);
// Route::post('contact', ['as' => 'postContact', 'uses' => 'ContactController@postContact']);

// Route::get('about', ['as' => 'about', 'uses' => 'PageControler@about']);

// Route::resource('posts', 'PostController');
// Route::resource('portfolio', 'PortfolioController');
// Route::get('styles/{tag}', 'PortfolioController@getByStyle');


// routes for auth
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('password/forgot', 'Auth\PasswordController@getEmail');
Route::post('password/forgot', 'Auth\PasswordController@postEmail');
Route::get('password/reset', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
