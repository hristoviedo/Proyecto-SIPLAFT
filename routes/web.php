<?php

Auth::routes(); // Todas las funciones de usuarios

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

Route::get('/simulation', 'HomeController@simulation')->name('simulation.col'); // /simulation llama a la función 'simulation' de HomeController

Route::get('/home.col', 'HomeController@home_colaborador')->name('home.col'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/home.adm', 'HomeController@home_administrador')->name('home.adm'); // /home.adm llama a la función 'home_administrador' de HomeController

//Route::get('/home.sup', 'HomeController@home_supervisor')->name('home.sup'); // /home.sup llama a la función 'home_supervisor' de HomeController

Route::get('/sup.client', 'HomeController@sup_client')->name('home.sup'); // /home.sup llama a la función 'sup_client' de HomeController

Route::get('/sup.transaction', 'HomeController@sup_transaction')->name('home.trans'); // /home.trans llama a la función 'sup_transaction' de HomeController

Route::get('/clients.descarga', 'HomeController@exportClientExcel')->name('client.export.excel'); // /clients.descarga llama a la función 'exportClientExcel' de HomeController

Route::get('/transactions.descarga', 'HomeController@exportTransactionExcel')->name('transactions.export.excel'); // /transactions.descarga llama a la función 'exportTransactionExcel' de HomeController

Route::post('/clients.carga', 'HomeController@importClientExcel')->name('client.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::post('/transactions.carga', 'HomeController@importTransactionExcel')->name('transaction.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::get('/list-clients/indexRisk', 'ClientController@indexRisk'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-clients/indexFunding', 'ClientController@indexFunding'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-clients/indexActivity', 'ClientController@indexActivity'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-clients/indexAll', 'ClientController@index2'); // /list llama a la función 'index2' de ClientController

Route::get('/list-trans/indexAll', 'TransactionController@indexTransactionsAll'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-users/indexAll', 'UserController@indexUsersAll'); // /list1 llama a la función 'index' de ClientController

Route::get('/list-users/indexCompany', 'UserController@indexCompany'); // /list2 llama a la función 'index2' de ClientController

Route::resource('/list-clients', 'ClientController'); // /list1 llama a la función 'index' de ClientController

Route::resource('/list-trans', 'TransactionController'); // /list1 llama a la función 'index' de ClientController

Route::resource('/list-users', 'UserController'); // /list1 llama a la función 'index' de ClientController