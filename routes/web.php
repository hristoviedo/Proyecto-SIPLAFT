<?php

/**
 * Rutas de acceso a base de datos
 */

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

Route::get('/col.simulation', 'HomeController@col_simulation')->name('col.simulation'); // /simulation llama a la función 'simulation' de HomeController

Route::get('/col.client', 'HomeController@col_client')->name('col.client'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/col.transaction', 'HomeController@col_transaction')->name('col.transaction'); // /home.col llama a la función 'home_colaborador' de HomeController

Route::get('/sup.client', 'HomeController@sup_client')->name('sup.client'); // /home.sup llama a la función 'sup_client' de HomeController

Route::get('/sup.transaction', 'HomeController@sup_transaction')->name('sup.transaction'); // /home.trans llama a la función 'sup_transaction' de HomeController

Route::get('/adm.user', 'AdminController@adm_user')->name('adm.user'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.role', 'AdminController@adm_role')->name('adm.role'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.company', 'AdminController@adm_company')->name('adm.company'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.funding', 'AdminController@adm_funding')->name('adm.funding'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.risk', 'AdminController@adm_risk')->name('adm.risk'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.activity', 'AdminController@adm_activity')->name('adm.activity'); // /home.adm llama a la función 'home_administrador' de HomeController

Route::get('/adm.log', 'AdminController@adm_log')->name('adm.log'); // /home.adm llama a la función 'home_administrador' de HomeController

/**
 * Rutas de acceso a base de datos
 */

Auth::routes(); // Todas las funciones de usuarios

Route::post('/clients.carga', 'HomeController@clientImportExcel')->name('client.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::post('/transactions.carga', 'HomeController@transactionImportExcel')->name('transaction.import.excel'); // /descarga llama a la función 'importExcel' de HomeController

Route::get('/clients.descarga', 'HomeController@clientExportExcel')->name('client.export.excel'); // /clients.descarga llama a la función 'exportClientExcel' de HomeController

Route::get('/transactions.descarga', 'HomeController@transactionExportExcel')->name('transactions.export.excel'); // /transactions.descarga llama a la función 'exportTransactionExcel' de HomeController

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