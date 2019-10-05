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

Route::get('/', 'TodoListController@index');

Route::get('api/todolists', 'TodoListController@get');

Route::post('api/todolists', 'TodoListController@store');


Route::delete('api/todolists', 'TodoListController@destroy');
