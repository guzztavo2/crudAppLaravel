<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\InformacaoController@index')->name('home');
//Route::get('/','App\Http\Controllers\InformacaoController@index')->name('home');

Route::post('gerarInformacao', 'App\Http\Controllers\InformacaoController@gerarInformacao')->name('gerarInformacao');
Route::post('limparTodasInformacao', 'App\Http\Controllers\InformacaoController@limparTodasInformacoes')->name('limparTodasInformacao');
Route::post('removerInformacao', 'App\Http\Controllers\InformacaoController@removerInformacao')->name('removerInformacao');

Auth::routes();

