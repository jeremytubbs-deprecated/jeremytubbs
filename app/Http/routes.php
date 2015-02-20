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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

// Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@getContact']);
// Route::post('contact', ['as' => 'postContact', 'uses' => 'ContactController@postContact']);

// Route::get('about', ['as' => 'about', 'uses' => 'PageControler@about']);

// Route::resource('posts', 'PostController');
// Route::resource('portfolio', 'PortfolioController');
// Route::get('styles/{tag}', 'PortfolioController@getByStyle');


// routes for auth
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
