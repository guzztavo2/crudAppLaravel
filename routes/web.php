<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\InformacaoController@index')->name('home');
//Route::get('/','App\Http\Controllers\InformacaoController@index')->name('home');

Route::post('gerarInformacao', 'App\Http\Controllers\InformacaoController@gerarInformacao')->name('gerarInformacao');
Route::post('limparTodasInformacao', 'App\Http\Controllers\InformacaoController@limparTodasInformacoes')->name('limparTodasInformacao');
Route::post('removerInformacao', 'App\Http\Controllers\InformacaoController@removerInformacao')->name('removerInformacao');
Route::post('editarInformacao', 'App\Http\Controllers\InformacaoController@editarInformacao')->name('editarInformacao');
Route::post('inserirNovaInformacao', 'App\Http\Controllers\InformacaoController@inserirNovaInformacao')->name('inserirNovaInformacao');

Auth::routes();
