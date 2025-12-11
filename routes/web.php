<?php
use App\Routes\Route;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;

Route::get('/', 'ClientController@index');
Route::get('/create', 'ClientController@create');
Route::post('/create', 'ClientController@store');

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::get('/publish', 'TimbreController@create');
Route::post('/publish', 'TimbreController@store');

Route::get('/image', 'ImageController@create');
Route::post('/image', 'ImageController@store');
Route::post('/delete', 'ImageController@delete');
  
Route::get('/placer', 'EnchereController@create');
Route::post('/placer', 'EnchereController@store');

Route::get('/encheres', 'EncheresController@create');
Route::post('/encheres', 'EncheresController@store');
Route::post('/delete-enchere', 'EncheresController@delete');

Route::dispatch();