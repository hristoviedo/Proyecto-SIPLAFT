<?php

Auth::routes(); // Todas las funciones de usuarios

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

// Route::get('/home', 'HomeController@index')->name('home')->name('home'); // /home llama a la función 'home' de HomeController

Route::get('/home.col', 'HomeController@home_colaborador')->name('home.col'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/home', 'HomeController@home_supervisor')->name('home.sup'); // /home.sup llama a la función 'home_supervisor' de HomeController

Route::get('/descarga', 'HomeController@exportExcel')->name('client.excel'); // /descarga llama a la función 'exportExcel' de HomeController

Route::post('/carga', 'HomeController@importExcel')->name('client.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::get('/list/index2', 'ClientController@index2')->name('list2'); // /list2 llama a la función 'index2' de ClientController

Route::resource('/list', 'ClientController'); // /list1 llama a la función 'index' de ClientController