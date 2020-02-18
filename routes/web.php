<?php

/**
 * Rutas de acceso a base de datos
 */

Route::get('/', 'HomeController@welcome')->name('welcome'); //La raiz (/) llama a la función 'welcome' de HomeController

//-------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/col.simulation', 'ColController@col_simulation')->name('col.simulation'); // /col.simulation llama a la función 'col_simulation' de ColController

Route::get('/col.client', 'ColController@col_client')->name('col.client'); // /col.client llama a la función 'col_client' de ColController

Route::get('/col.transaction', 'ColController@col_transaction')->name('col.transaction'); // /col.transaction llama a la función 'col_transaction' de ColController

Route::get('/col.report', 'ColController@col_report')->name('col.report'); // /col.report llama a la función 'col_report' de ColController

Route::get('/col.report.all', 'ColController@col_report_all')->name('col.report.all'); // /col.report llama a la función 'col_report' de ColController

//-------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/sup.client', 'SupController@sup_client')->name('sup.client'); // /sup.client llama a la función 'sup_client' de SupController

Route::get('/sup.transaction', 'SupController@sup_transaction')->name('sup.transaction'); // //sup.transaction llama a la función 'sup_transaction' de SupController

Route::get('/sup.report', 'SupController@sup_report')->name('sup.report'); // /sup.report llama a la función 'sup_report' de SupController

Route::get('/sup.report.all', 'SupController@sup_report_all')->name('sup.report.all'); // /sup.report.all llama a la función 'sup_report.all' de SupController
//-------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/adm.user', 'AdminController@adm_user')->name('adm.user'); // /adm.user llama a la función 'adm_user' de AdminController

Route::get('/adm.create.user', 'AdminController@adm_create_user')->name('adm.create.user'); // /adm.create.user llama a la función 'adm_create_user' de AdminController

Route::get('/adm.show.user/{id}', 'AdminController@adm_show_user')->name('adm.show.user'); // /adm.update.user llama a la función 'adm_update_user' de AdminController

Route::get('/adm.record', 'AdminController@adm_record')->name('adm.record'); // /adm.record llama a la función 'adm_record' de AdminController

Route::get('/user.update', 'AdminController@user_update')->name('user.update'); // /user.update llama a la función 'user_update' de AdminController
/**
 * Rutas de acceso a base de datos
 */

// Auth::routes(['verify' => true]); // Todas las funciones de usuarios
// Auth::routes(['register' => false]); // Todas las funciones de usuarios
// Auth::routes();

Route::post('/clients.carga', 'ColController@clientImportExcel')->name('client.import.excel'); // /clients.carga llama a la función 'clientImportExcel' de ColController

Route::post('/register', 'UserController@register')->name('register'); // /clients.carga llama a la función 'clientImportExcel' de ColController

Route::post('/transactions.carga', 'ColController@transactionImportExcel')->name('transaction.import.excel'); // /descarga llama a la función 'transactionImportExcel' de ColController

Route::get('/clients.descarga', 'ColController@clientExportExcel')->name('client.export.excel'); // /clients.descarga llama a la función 'clientExportExcel' de ColController

Route::get('/col.manual', 'ColController@userManual')->name('col.manual'); // /clients.descarga llama a la función 'clientExportExcel' de ColController

Route::get('/sup.manual', 'SupController@userManual')->name('sup.manual'); // /clients.descarga llama a la función 'clientExportExcel' de ColController

Route::get('/adm.manual', 'AdminController@userManual')->name('adm.manual'); // /clients.descarga llama a la función 'clientExportExcel' de ColController

Route::post('/transactions.report', 'ColController@transactionExportExcel')->name('transactions.export.excel'); // /transactions.descarga llama a la función 'transactionExportExcel' de ColController

Route::post('/transactions.report.sup', 'SupController@transactionExportExcel')->name('transactions.report.excel.sup'); // /transactions.descarga llama a la función 'transactionExportExcel' de ColController

Route::get('/transactions.all.report', 'ColController@transactionExportAllExcel')->name('transactions.all.excel'); // /transactions.descarga llama a la función 'transactionExportExcel' de ColController

Route::get('/transactions.all.report.sup', 'SupController@transactionExportAllExcel')->name('transactions.all.excel.sup'); // /transactions.descarga llama a la función 'transactionExportExcel' de ColController

Route::get('/list-clients/indexAll', 'ClientController@index2'); // /list-clients/indexAll llama a la función 'index2' de ClientController

Route::get('/list-transxclient/indexAll', 'ClientController@indexTransactionxClientAll'); // /list-transxclient/indexAll llama a la función 'indexTransactionxClientAll' de ClientController

Route::get('/list-trans/indexAll', 'TransactionController@indexTransactionsAll'); // /list-trans/indexAll llama a la función 'indexTransactionsAll' de TransactionController

Route::get('/list-users/indexAll', 'UserController@indexUsersAll'); // /list-users/indexAll llama a la función 'indexUsersAll' de UserController

Route::get('/list-companies/indexAll', 'UserController@indexCompaniesAll'); // /list-companies/indexAll llama a la función 'indexCompaniesAll' de UserController

Route::get('/list-roles/indexAll', 'UserController@indexRolesAll'); // /list-roles/indexAll llama a la función 'indexRolesAll' de UserController

Route::delete('/users/{id}', 'UserController@destroy'); // //users/{id} llama a la función 'destroy' de UserController

Route::put('/users/{id}', 'UserController@update'); // //users/{id} llama a la función 'update' de UserController

Route::get('/list-clientxcompany/indexAll', 'ClientController@indexClientXCompany'); // /list-clientxcompany/indexAll llama a la función 'indexClientXCompany' de ClientController

Route::resource('/list-clients', 'ClientController'); // /list-clients llama a las funciones de ClientController

Route::resource('/list-trans', 'TransactionController'); // /list-trans llama a las funciones de TransactionController

Route::resource('/list-users', 'UserController'); // /list-users llama a las funciones de UserController
