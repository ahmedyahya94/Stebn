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

Route::get('welcome', 'WelcomeController@index');

Route::get('authentication/register', 'AuthenticationController@register');

Route::post('register', 'AuthenticationController@store');

Route::get('authentication/login', 'AuthenticationController@login');

Route::post('login', 'AuthenticationController@authenticate');

Route::get('logout', 'AuthenticationController@Deauthenticate');

Route::get('admin/welcome', 'AdminController@index');

Route::get('admin/cards', 'AdminController@cards');

Route::post('CreateCards', 'AdminController@CreateCards');