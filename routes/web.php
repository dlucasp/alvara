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

Route::get('/', function () {
    return response()->redirectToRoute('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/solicitacao', 'SolicitationController@index')->name('solicitation.index');
Route::post('/solicitacao', 'SolicitationController@store')->name('solicitation.store');
Route::post('/solicitacao/{solicitation}/upload', 'SolicitationController@uploadDocument')->name('solicitation.uploadDocument');
Route::post('/solicitacao/{solicitation}/annotation', 'SolicitationController@addAnnotation')->name('solicitation.addAnnotation');
Route::get('/solicitacao/{solicitation}', 'SolicitationController@show')->name('solicitation.show');
Route::get('/solicitacao/{solicitation}/{document}', 'SolicitationController@download')->name('solicitation.documents.download');
Route::post('/solicitacao/{solicitation}/{document}', 'SolicitationController@approve')->name('solicitation.documents.approve');
