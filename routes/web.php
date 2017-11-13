<?php
use App\Inscricao;
use App\PagamntoMensalidade;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('wel','HomeController@wel');
Route::get('/','HomeController@index');
Route::get('/logon','HomeController@logon');
Route::get('/factura','MensalidadeController@factura');

Route::group(['prefix'=>'mensalidade'], function (){
    Route::get('/','MensalidadeController@index');
    Route::get('registar','MensalidadeController@registarMensalidade');
});

Route::group(['prefix'=>'extras'], function (){
    Route::get('/','HomeController@lock');
});

Route::get('exportDevedoresPDF',function (){

    /*Busca de dados de alunos(DEVEDORES) e NAO DEVEDOREs que devem num determinado ano e mes para  exportar fil=cheiro pdf*/
    $tabela =$_GET['tabela'];
//    $idAlunos = PagamntoMensalidade::query()->join('mensalidades','pagamnto_mensalidades.idMensalidade','=','mensalidades.id')->select('idAluno')->where('mes',$_GET['mes'])->get();
    $idAlunos = PagamntoMensalidade::query()->select('idAluno')->where('mes',$_GET['mes'])->get();
    $ids='';
    foreach ($idAlunos as $i){
        $ids = $i->idAluno.' '.$ids;
    }
    $mesAno = $_GET['mes'].'-'.$_GET['ano'];
    $arrayIds = explode(' ',trim(rtrim($ids)));

    $dados = Inscricao::query()
        ->join('alunos','alunos.id','=','inscricaos.idAluno')
        ->join('cursos','cursos.id','=','inscricaos.idCurso')
        ->join('turmas','turmas.id','=','inscricaos.idCurso')
        ->select('alunos.nome as nomeAluno','alunos.*','cursos.nome as curso','cursos.valormensal as divida','turmas.nome as turma')
        ->whereNotIn('inscricaos.idAluno',$arrayIds)->where('inscricaos.ano','=',$_GET['ano'])->get();


    $dados2 = Inscricao::query()
        ->join('alunos','alunos.id','=','inscricaos.idAluno')
        ->join('cursos','cursos.id','=','inscricaos.idCurso')
        ->join('turmas','turmas.idCurso','=','inscricaos.idCurso')
        ->select('alunos.nome as nomeAluno','alunos.*','cursos.nome as curso','cursos.valormensal as divida','turmas.nome as turma')
        ->whereIn('inscricaos.idAluno',$arrayIds)->where('inscricaos.ano','=',$_GET['ano'])->get();

    if($tabela == 'devedor'){

        $pdf = PDF::loadView('export.devedores',['dados'=>$dados,'mesAno'=>$mesAno]);
        return $pdf->download('deveores_'.$mesAno.'.pdf');
    }elseif ($tabela == 'naodevedor'){
        $pdf = PDF::loadView('export.naodevedores',['dados'=>$dados2,'mesAno'=>$mesAno]);
        return $pdf->download('naoDeveores_'.$mesAno.'.pdf');
    }elseif ($tabela == 'todos'){
        $pdf = PDF::loadView('export.devsenao',['devedores'=>$dados,'honestos'=>$dados2,'mesAno'=>$mesAno]);
        return $pdf->download('todosDeveNa_'.$mesAno.'.pdf');
    }
});
