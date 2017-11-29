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
Route::post('getValorAdiantado','MensalidadeController@getValorAdiantado')->name('getValorAdiantado');
Route::post('getMeses','MensalidadeController@getMeses')->name('getMeses');

/*Aluo*/
//Route::post('getCursosAluno','AlunoController@getCursosAluno')->name('getCursosAluno');


/*Pagamento*/
//Route::post('salvarPagamento','PagamentoController@salvarPagamento')->name('salvarPagamento');
Route::post('/getInscricao','InscricaoController@getInscricao');
Route::post('/getDadosInscricao','InscricaoController@getDadosInscricao');
Route::post('/updateMensalidade','MensalidadeController@updateMensalidade');

/*ExportPDF*/
Route::post('/exportarDevedores','ExportController@exportarDevedores');
Route::post('/exportarNaoDevedores','ExportController@exportarNaoDevedores');
Route::post('/exportarAll','ExportController@exportarAll');
