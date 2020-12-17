<?php

use Illuminate\Support\Facades\Route;

Route::view('home', 'home')->name('home');

Route::resource('personas', 'PersonaController');
Route::resource('contratos', 'ContratoController');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
