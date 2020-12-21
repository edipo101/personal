<?php

use Illuminate\Support\Facades\Route;

Route::get('home', 'HomeController@index')->name('home');

Route::resource('acontrato', 'PersonalContratoController');
Route::resource('contratos', 'ContratoController');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
