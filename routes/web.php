<?php

use Illuminate\Support\Facades\Route;

Route::view('home', 'home')->name('home');

Route::resource('personas', 'PersonaController');

// Auth::routes();

// Route::view('/', 'auth.login');
// Route::view('/', 'layouts.admin');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
