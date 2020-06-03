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

Route::get('/', 'Site\SiteController@index')->name('site');
Route::get('/artigo/{id}/{titulo?}', 'Site\SiteController@artigoDetalhes')->name('artigo');
Route::get('/pesquisa', 'Site\SiteController@buscarArtigos')->name('site-pesquisa');

Auth::routes();

//Route::get('/', 'AdminController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('can:eAutor');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function (){
    Route::resource('artigos', 'ArtigosController')->middleware('can:eAutor');
    Route::resource('usuarios', 'UsuariosController')->middleware('can:eAdmin');
    Route::resource('autores', 'AutoresController')->middleware('can:eAdmin');
    Route::resource('adm', 'AdminController')->middleware('can:eAdmin');
});
