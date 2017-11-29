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
//Route::get('/listarPorAluno','MensalidadeController@listarPorAluno')->name('listarPorAluno');


Route::get('wel','HomeController@wel');
Route::get('/','HomeController@index');
Route::get('/logon','HomeController@logon');
Route::get('/factura','MensalidadeController@factura');

Route::group(['prefix'=>'mensalidade'], function (){
    Route::get('/','MensalidadeController@index');
    Route::get('registar','MensalidadeController@registarMensalidade');
});

Route::group(['prefix'=>'aluno'], function (){
    Route::get('/','AlunoController@index');
    Route::get('registar','MensalidadeController@registarMensalidade');
});

Route::group(['prefix'=>'extras'], function (){
    Route::get('lock','HomeController@lock');
    Route::get('logon','HomeController@logon');
});

//Route::get('exportDevedoresPDF','ExportController@ExportarDevedores');
//Route::post('/exportDevedoresPDF','ExportController@ExportarDevedores');

//Route::get('exportDevedoresPDF',function (){

//    /*Busca de dados de alunos(DEVEDORES) e NAO DEVEDOREs que devem num determinado ano e mes para  exportar fil=cheiro pdf*/
//    $tabela =$_GET['tabela'];
//    $idAlunos = PagamntoMensalidade::query()->select('idAluno')->where('mes',$_GET['mes'])->get();
//    $ids='';
//    foreach ($idAlunos as $i){
//        $ids = $i->idAluno.' '.$ids;
//    }
//    $mesAno = $_GET['mes'].'-'.$_GET['ano'];
//    $idAlunoInscritos = Inscricao::query()->where('estado','<>','pre-inscrito')->distinct()->pluck('idAluno')->toArray();
//    sort($idAlunoInscritos);
//
//    $numNaoPagamento=0;
//
//    $listaCursos=array(); $listaIdsAlunos = array(); $listaDeTurma = array(); $listaDeValor=array();
//    for ($c =0; $c< sizeof($idAlunoInscritos); $c++){
//        $cursosAlunoo = Inscricao::query()->join('alunos','alunos.id','=','inscricaos.idAluno')->join('cursos','cursos.id','=','inscricaos.idCurso')
//            ->where('inscricaos.idAluno','=',$idAlunoInscritos[$c])->pluck('cursos.nome')->toArray();
//
//        for ($k =0; $k< sizeof($cursosAlunoo); $k++){
//            $resultado = PagamntoMensalidade::query()->where('idAluno','=',$idAlunoInscritos[$c])->where('curso','=',$cursosAlunoo[$k])->where('mes','=',$_GET['mes'])->get();
//            if($resultado->isEmpty()){
//                $numNaoPagamento +=1;
//                array_push($listaIdsAlunos,$idAlunoInscritos[$c]);
//                array_push($listaCursos,$cursosAlunoo[$k]);
//
//                /*Burca a determinada turma do aluno*/
//                $turma = \App\TurmaAluno::query()->join('turmas','turmas.id','=', 'turma_alunos.idTurma')
//                    ->where('turma_alunos.idAluno','=',$idAlunoInscritos[$c])
//                    ->where('turmas.nomeCurso','=',$cursosAlunoo[$k])->pluck('turmas.nome');
//                array_push($listaDeTurma,$turma);
//
//                /*busca o valor de Mensalidade */
//                $valor = \App\Curso::query()->where('nome','=',$cursosAlunoo[$k])->pluck('valormensal');
//                array_push($listaDeValor, $valor);
//            }
//        }
//    }
//    $devedores = Inscricao::query()
//        ->join('alunos','alunos.id','=','inscricaos.idAluno')
//        ->select('alunos.nome as nomeAluno','alunos.*')
//        ->whereIn('inscricaos.idAluno',$listaIdsAlunos)->get();
//
//    $naddevedores = PagamntoMensalidade::query()
//        ->join('alunos','alunos.id','=','pagamnto_mensalidades.idAluno')
//        ->join('turmas','turmas.nomeCurso','=','pagamnto_mensalidades.curso')
//        ->select('alunos.nome as nomeAluno','alunos.*','turmas.nome as turma','turmas.nomeCurso as curso','pagamnto_mensalidades.valorTotal as valor','pagamnto_mensalidades.mes','pagamnto_mensalidades.idAluno')
//        ->where('mes',$_GET['mes'])->where('anoPago',$_GET['ano'])->get();
//
//
//    if($tabela == 'devedor'){
//        $pdf = PDF::loadView('export.devedores',['devedores'=>$devedores,'mesAno'=>$mesAno,'cursos'=>$listaCursos,'turma'=>$listaDeTurma,'vezes'=>$numNaoPagamento,'valor'=>$listaDeValor]);
//        return $pdf->download('devedores_'.$mesAno.'.pdf');
//    }elseif ($tabela == 'naodevedor'){
//        $pdf = PDF::loadView('export.naodevedores',['dados'=>$naddevedores,'mesAno'=>$mesAno]);
//        return $pdf->download('naoDevedores_'.$mesAno.'.pdf');
//    }elseif ($tabela == 'todos'){
//        $pdf = PDF::loadView('export.devsenao',['devedores'=>$devedores,'honestos'=>$naddevedores,'mesAno'=>$mesAno,'cursos'=>$listaCursos,'turma'=>$listaDeTurma,'vezes'=>$numNaoPagamento,'valor'=>$listaDeValor]);
//        return $pdf->download('todosDeveNa_'.$mesAno.'.pdf');
//    }
//});

Route::get('exportAluno',function (){
    $ano = $_GET['ano'];

    $mensalidade = PagamntoMensalidade::query()
        ->join('alunos','pagamnto_mensalidades.idAluno','=','alunos.id')
        ->select('pagamnto_mensalidades.estado as mesEstado','alunos.*','alunos.codigo as cdd','pagamnto_mensalidades.*')
        ->where('idAluno',$_GET['idAluno'])->where('anoPago',$_GET['ano'])->get();

    $mesesPagos = '';
    $def = \App\Def_Mensalidade::query()
        ->join('mes','def__mensalidades.mescomeco','=','mes.numero')
        ->select('mes.*','def__mensalidades.mesfim')->where('ano',$_GET['ano'])->first();
    foreach ($mensalidade as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
    $mesNaoP = \App\Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();


    $codigo ='';$nome ='';foreach ($mensalidade as $mk){$codigo = $mk->codigo; $nome= $mk->nome.' '.$mk->apelido;}
    $curso = $_GET['curso'];
    $pdf = PDF::loadView('export.alunoexport',['mensalidade'=>$mensalidade,'curso'=>$curso,'ano'=>$ano,'nome'=>$nome,'mesNaoPagas'=>$mesNaoP]);



    return $pdf->download($codigo.'_'.$curso.'.pdf');
});

Route::post('/salvarPagamento','PagamentoController@salvarPagamento');
Route::post('/salvarMensalidade','MensalidadeController@salvarMensalidade');
Route::get('ok','AlunoController@salvarPreInscricao');
//Route::post('/updateMensalidade','MensalidadeController@updateMensalidade');




