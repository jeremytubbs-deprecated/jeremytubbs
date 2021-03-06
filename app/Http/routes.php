<?php

// pages
Route::get('/', ['as' => 'pages.home', 'uses' => 'PagesController@home']);
Route::get('about', ['as' => 'pages.about', 'uses' => 'PagesController@about']);

// contact
Route::get('contact', ['as' => 'pages.contact', 'uses' => 'ContactController@getContact']);
Route::post('contact', ['as' => 'pages.contact', 'uses' => 'ContactController@postContact']);

// admin pages
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function()
{
	Route::get('/', ['as' => 'admin.home', 'uses' => 'AdminController@home']);
	Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	Route::resource('projects', 'ProjectsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	Route::resource('projects.assets', 'ProjectAssetsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	Route::resource('covers', 'CoversController', ['only' => ['store', 'update', 'destroy']]);
});

// posts pages
Route::get('posts', ['as' => 'posts.index', 'uses' => 'PostsController@index']);
Route::get('posts/{slug}', ['as' => 'posts.show', 'uses' => 'PostsController@show']);

// projects pages
Route::get('projects', ['as' => 'projects.index', 'uses' => 'ProjectsController@index']);
Route::get('projects/{slug}', ['as' => 'projects.show', 'uses' => 'ProjectsController@show']);

// routes for auth
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('password/forgot', 'Auth\PasswordController@getEmail');
Route::post('password/forgot', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset/{token}', 'Auth\PasswordController@postReset');
