<?php

use Illuminate\Support\Facades\Route;

Route::get('home', 'HomeController@index')->name('home');

Route::resource('acontrato', 'PersonalContratoController');

Route::get('contratos', 'ContratoController@index')->name('contratos.index');
Route::get('contratos/2021', 'ContratoController@gestion_2021')->name('contratos.2021');
Route::get('contratos/create', 'ContratoController@create')->name('contratos.create');
Route::post('contratos/store', 'ContratoController@store')->name('contratos.store');
Route::get('contratos/{id}/edit', 'ContratoController@edit')->name('contratos.edit');
Route::patch('contratos/{id}', 'ContratoController@update')->name('contratos.update');

Route::resource('consultorias', 'ConsultoriaController');

Route::get('funcionarios/save_obs', 'FuncionarioController@save_obs')->name('funcionarios.save_obs');
Route::get('funcionarios/view', 'FuncionarioController@view')->name('funcionarios.view');
Route::get('funcionarios/search', 'FuncionarioController@search')->name('funcionarios.search');
Route::get('funcionarios/lactancia', 'FuncionarioController@func_lactancia')->name('funcionarios.lactancia');
Route::get('funcionarios/codepedis', 'FuncionarioController@func_codepedis')->name('funcionarios.codepedis');

Route::get('unidades/items', 'UnidadController@getItems')->name('unidades.getitems');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
