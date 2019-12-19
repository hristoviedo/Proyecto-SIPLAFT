<?php

/**
 * Rutas de acceso a base de datos
 */

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

Route::get('/col.simulation', 'HomeController@col_simulation')->name('col.simulation'); // /simulation llama a la función 'simulation' de HomeController

Route::get('/col.client', 'HomeController@col_client')->name('col.client'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/col.transaction', 'HomeController@col_transaction')->name('col.transaction'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/col.report', 'ColController@col_report')->name('col.report'); // /report llama a la función 'report' de SupController

Route::get('/sup.client', 'HomeController@sup_client')->name('sup.client'); // /home.sup llama a la función 'sup_client' de HomeController

Route::get('/sup.transaction', 'HomeController@sup_transaction')->name('sup.transaction'); // /home.trans llama a la función 'sup_transaction' de HomeController

//-------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/adm.user', 'AdminController@adm_user')->name('adm.user'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.record', 'AdminController@adm_record')->name('adm.record'); // /home.adm llama a la función 'home_administrador' de HomeController

/**
 * Rutas de acceso a base de datos
 */

Auth::routes(); // Todas las funciones de usuarios

Route::post('/clients.carga', 'HomeController@clientImportExcel')->name('client.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::post('/transactions.carga', 'HomeController@transactionImportExcel')->name('transaction.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::get('/clients.descarga', 'HomeController@clientExportExcel')->name('client.export.excel'); // /clients.descarga llama a la función 'exportClientExcel' de HomeController

Route::get('/transactions.descarga', 'HomeController@transactionExportExcel')->name('transactions.export.excel'); // /transactions.descarga llama a la función 'exportTransactionExcel' de HomeController

Route::get('/list-clients/indexAll', 'ClientController@index2'); // /list llama a la función 'index2' de ClientController

Route::get('/list-transxclient/indexAll', 'ClientController@indexTransactionxClientAll'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-trans/indexAll', 'TransactionController@indexTransactionsAll'); // /list2 llama a la función 'index2' de ClientController

Route::get('/list-users/indexAll', 'UserController@indexUsersAll'); // /list1 llama a la función 'index' de ClientController

Route::get('/list-companies/indexAll', 'UserController@indexCompaniesAll'); // /list1 llama a la función 'index' de ClientController

Route::get('/list-roles/indexAll', 'UserController@indexRolesAll'); // /list1 llama a la función 'index' de ClientController

Route::delete('/users/{id}', 'UserController@destroy'); // /list1 llama a la función 'index' de ClientController

Route::put('/users/{id}', 'UserController@update'); // /list1 llama a la función 'index' de ClientController

Route::get('/list-clientxcompany/indexAll', 'ClientController@indexClientXCompany'); // /list2 llama a la función 'index2' de ClientController

Route::resource('/list-clients', 'ClientController'); // /list1 llama a la función 'index' de ClientController

Route::resource('/list-trans', 'TransactionController'); // /list1 llama a la función 'index' de ClientController

Route::resource('/list-users', 'UserController'); // /list1 llama a la función 'index' de ClientController
