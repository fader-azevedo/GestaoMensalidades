<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('graficoMensalidade','HomeController@graficoMensalidade')->name('graficoMensalidade');
Route::post('getMesesPorCurso','MensalidadeController@getMesesPorCurso')->name('getMesesPorCurso');
Route::post('getModal','MensalidadeController@getModal')->name('getModal');

/*Mensalidades*/
Route::post('listarTodasMensalidades','MensalidadeController@listarTodasMensalidades')->name('listarTodasMensalidades');
Route::post('getDevedoresMes','MensalidadeController@getDevedoresMes')->name('getDevedoresMes');
Route::post('listarPorAluno','MensalidadeController@listarPorAluno')->name('listarPorAluno');
Route::post('getMesAPagar','MensalidadeController@getMesAPagar')->name('getMesAPagar');
Route::post('exportaDevedores','MensalidadeController@exportaDevedores')->name('exportaDevedores');
Route::post('getDividas','MensalidadeController@getDividas')->name('getDividas');

Route::post('pagar','MensalidadeController@pagar')->name('pagar');

/*Aluo*/
Route::post('getCursosAluno','AlunoController@getCursosAluno')->name('getCursosAluno');