<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

Route::get('/home', 'HomeController@index')->name('home'); // /home llama a la función 'home' de HomeController

Route::get('/home.col', 'HomeController@descargar_clientes')->name('home.col'); // /home llama a la función 'home' de HomeController

Route::get('/descarga', 'HomeController@exportExcel')->name('client.excel'); // /carga llama a la función 'exportExcel' de HomeController

Route::post('/carga', 'HomeController@importExcel')->name('client.import.excel');