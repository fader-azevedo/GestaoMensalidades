<?php

namespace App\Http\Controllers;
use App\TurmaAluno;
use Illuminate\Database\Schema;
use App\Aluno;
use App\Curso;
use App\Def_Mensalidade;
use App\Lenovo;
use App\Mensalidade;
use App\Inscricao;
use App\Mes;
use App\Pagamento;
use App\PagamntoMensalidade;
use Carbon\Carbon;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Controller;


class MensalidadeController extends Controller{


    private $mensalidade;
    private $aluno;
    private $valorTotal;
    private $valorMensal;
    private $anos;
    private $anoDefido;
    private $numAlunos;
    private $intervalo;
    protected $pagament;
    public function __construct(Pagamento $pagamento){
        $this->mensalidade = new Mensalidade();
        $this->aluno = new Aluno();
        $this->numAlunos = Aluno::all()->count();

        
        $anoActual = date('Y');
        $this->anos = Def_Mensalidade::query()->pluck('ano');
        $def = Def_Mensalidade::query()->where('ano',$anoActual)->get();
        foreach ($def as $d){
            $this->valorTotal = ($d->intervalo+1)*$d->valormensal;
            $this->valorMensal = $d->valormensal;
            $this->anoDefido = $d->ano;
            $this->intervalo = $d->intervalo;
        }
    }

    public function pagar(Request $request){

    }


    public function index(){
        $alunnosInscritos = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()->select('alunos.*')->where('estado','=','inscrito')->get();

        $mesesPagos = $this->getMesesPagos($this->anoDefido);
        $mesesAPagar = $this->getMesAPagar($this->anoDefido);
        $anosPay = $this->anos;
//        return view('mensalidade.listar',['valorMensal'=>$this->valorMensal,'valorTotal'=>$this->valorTotal, 'alu'=>$alunnosInscritos,'numAlunos'=>$this->numAlunos,'anos'=>$anosPay,'mesesPagos'=>$mesesPagos,'mesesAPagar'=>$mesesAPagar,'intervalo'=>$this->intervalo]);
        return view('mensalidade.listar',['alu'=>$alunnosInscritos,'anos'=>$anosPay,'mesesPagos'=>$mesesPagos,'mesesAPagar'=>$mesesAPagar,'intervalo'=>$this->intervalo]);
    }

    public function getMesesPorCurso(){
        $mensalidade = PagamntoMensalidade::query()
            ->join('mensalidades','pagamnto_mensalidades.idMensalidade','=','mensalidades.id')
            ->join('pagamentos','pagamnto_mensalidades.idPagamento','=','pagamentos.id')
            ->join('alunos','pagamnto_mensalidades.idAluno','=','alunos.id')
            ->join('inscricaos','inscricaos.idAluno','=','alunos.id')
            ->join('cursos','inscricaos.idCurso','=','cursos.id')
            ->select('mensalidades.estado as mesEstado','alunos.*','mensalidades.*','pagamentos.*','pagamnto_mensalidades.*','cursos.nome as curso')
            ->where('idAluno',$_POST['idAluno'])->where('idCurso',$_POST['idCurso'])->where('anoPago',$_POST['ano'])->get();

        return  response()->json(array('mensal'=> $mensalidade));
    }

    public function listarPorAluno(){
        $mensalidade = PagamntoMensalidade::query()->join('alunos','pagamnto_mensalidades.idAluno','=','alunos.id')->select('pagamnto_mensalidades.estado as mesEstado','alunos.*','pagamnto_mensalidades.*')->where('idAluno',$_POST['idAluno'])->where('anoPago',$_POST['ano'])->get();

        $mensalidade2 = PagamntoMensalidade::query()->join('alunos','pagamnto_mensalidades.idAluno','=','alunos.id')->select('pagamnto_mensalidades.estado as mesEstado','alunos.*','pagamnto_mensalidades.*')->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->get();

        /*Para registo de mensalidade*/
        $mesesPagos = '';
        $def = Def_Mensalidade::query()
            ->join('mes','def__mensalidades.mescomeco','=','mes.numero')
            ->select('mes.*','def__mensalidades.mesfim')->where('ano',$_POST['ano'])->first();
        foreach ($mensalidade as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
        $mesNaoP = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();

        $mesesPagos2 = '';$meses = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->get();
        foreach ($meses as $ms2){$mesesPagos2 = $mesesPagos2.' '.$ms2->mes;}$mesesNaoPAgos = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos2))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();

        $inscricao = Inscricao::query()->join('alunos','inscricaos.idAluno','=','alunos.id')->join('cursos','inscricaos.idCurso','=','cursos.id')->select('cursos.*','cursos.id as idCurso','alunos.foto as picture')->where('idAluno',$_POST['idAluno'])->where('estado','=','inscrito')->where('ano',$_POST['ano'])->get();
        return  response()->json(array('mensalidade'=> $mensalidade,'mesesNao'=>$mesNaoP,'mesesNaoPagos'=>$mesesNaoPAgos,'inscricao'=>$inscricao,'mensalidade2'=>$mensalidade2));
    }


    public function getMeses(){

        $meses = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->get();

        $mesesPagos = '';
        $def = Def_Mensalidade::query()
            ->join('mes','def__mensalidades.mescomeco','=','mes.numero')
            ->select('mes.*','def__mensalidades.mesfim')->where('ano',$_POST['ano'])->first();
        foreach ($meses as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
        $mesNaoP = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();

        return  response()->json(array('meses'=>$meses,'mesdAno'=>$mesNaoP));
    }



    public function registarMensalidade(){
        $alunnosInscritos = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()
            ->select('alunos.*')->where('estado','=','inscrito')->get();

        return view('mensalidade.registar',['alu'=>$alunnosInscritos]);
    }

    public function getDevedoresMes(){

        $tabela =$_POST['tabela'];
        $export =$_POST['tipo'];
        $idAlunoInscritos = Inscricao::query()->where('estado','<>','pre-inscrito')->distinct()->pluck('idAluno')->toArray();
        sort($idAlunoInscritos);

        $numNaoPagamento=0;
        $listaCursos=array(); $listaIdsAlunos = array(); $listaDeTurma = array(); $listaDeValor=array();
        for ($c =0; $c< sizeof($idAlunoInscritos); $c++){
            $cursosAlunoo = Inscricao::query()->join('alunos','alunos.id','=','inscricaos.idAluno')->join('cursos','cursos.id','=','inscricaos.idCurso')->where('inscricaos.idAluno','=',$idAlunoInscritos[$c])->pluck('cursos.nome')->toArray();

            for ($k =0; $k< sizeof($cursosAlunoo); $k++){
                $resultado = PagamntoMensalidade::query()->where('idAluno','=',$idAlunoInscritos[$c])->where('curso','=',$cursosAlunoo[$k])->where('mes','=',$_POST['mes'])->get();
                if($resultado->isEmpty()){
                    $numNaoPagamento +=1;
                    array_push($listaIdsAlunos,$idAlunoInscritos[$c]);
                    array_push($listaCursos,$cursosAlunoo[$k]);

                    /*Burca a determinada turma do aluno*/
                    $turma = TurmaAluno::query()->join('turmas','turmas.id','=', 'turma_alunos.idTurma')
                        ->where('turma_alunos.idAluno','=',$idAlunoInscritos[$c])
                        ->where('turmas.nomeCurso','=',$cursosAlunoo[$k])->pluck('turmas.nome');
                    array_push($listaDeTurma,$turma);

                    /*busca o valor de Mensalidade */
                    $valor = Curso::query()->where('nome','=',$cursosAlunoo[$k])->pluck('valormensal');
                    array_push($listaDeValor, $valor);
                }
            }
        }

        $devedores = Inscricao::query()
            ->join('alunos','alunos.id','=','inscricaos.idAluno')
            ->select('alunos.nome as nomeAluno','alunos.*')
            ->whereIn('inscricaos.idAluno',$listaIdsAlunos)->get();

        $naddevedores = PagamntoMensalidade::query()
            ->join('alunos','alunos.id','=','pagamnto_mensalidades.idAluno')
            ->join('turmas','turmas.nomeCurso','=','pagamnto_mensalidades.curso')
            ->select('alunos.nome as nomeAluno','alunos.*','turmas.nome as turma','turmas.nomeCurso as curso','pagamnto_mensalidades.valorTotal as valor','pagamnto_mensalidades.mes','pagamnto_mensalidades.idAluno')
            ->where('mes',$_POST['mes'])->where('anoPago',$_POST['ano'])->get();


        if($tabela === 'devedor' && $export === 'naoModal'){
            return response()->json(array('devedor'=>$devedores,'cursos'=>$listaCursos,'vezes'=>$numNaoPagamento,'turma'=>$listaDeTurma,'valor'=>$listaDeValor));
        }elseif ($tabela === 'naodevedor' && $export ==='naoModal'){
           return response()->json(array('naodevedor'=>$naddevedores));
        }

        if($tabela === 'todasTabelas' && $export === 'simModel'){
            return view('mensalidade.modal',['devedores'=>$devedores,'cursos'=>$listaCursos,'turma'=>$listaDeTurma,'vezes'=>$numNaoPagamento,'valor'=>$listaDeValor,'honestos'=>$naddevedores,'mes'=>$_POST['mes']]);
        }
    }

    /*Retorna uma lista de todos o meses que ainda nao foi feito pagamento*/
    public function getMesAPagar($ano){
        $mesesApagar='';
        $defin =Def_Mensalidade::query()->where('ano',$ano)->get();
        $mesesKexis = PagamntoMensalidade::query()->distinct()->pluck('mes')->count();
        foreach ($defin as $df){
            $mesIncial = $df->mescomeco;
            $mesFim = $df->mesfim;

            for ($numMes = $mesIncial+$mesesKexis; $numMes <= $mesFim; $numMes++){
                $getMeses = Mes::query()->where('numero',$numMes)->get();
                foreach ($getMeses as $r){
                    $mesesApagar = $mesesApagar.' '.$r->nome;
                }
            }
        }
        return explode(' ',trim(rtrim($mesesApagar)));
    }

    public function getMesesPagos($ano){
        $mesesPagos = PagamntoMensalidade::query()->distinct()->select('mes')->where('anoPago',$ano)->get();
        return $mesesPagos;
    }

    public function getModal(){
        return view('mensalidade.modal');
    }

    public function getValorAdiantado(){
        $adiantado = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->sum('divida');
        echo $adiantado;
    }

    public function getDividas(){

        $mensalidade = PagamntoMensalidade::query()->select('pagamnto_mensalidades.estado as mesEstado','pagamnto_mensalidades.*')->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->get();
        $mesesPagos = '';
        $def = Def_Mensalidade::query()->join('mes','def__mensalidades.mescomeco','=','mes.numero')->select('mes.*','def__mensalidades.mesfim')->where('ano',$_POST['ano'])->first();
        foreach ($mensalidade as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
        $mesNaoP = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();
        return response()->json(array('situacao'=>$mesNaoP,'mensal2'=>$mensalidade));
    }


    public function salvarMensalidade(Request $request){

        $pgm = new PagamntoMensalidade();
        $pgm->create($request->all());
        echo 'salvo com Sucesso';
    }

    public function updateMensalidade(){
        $idAluno = $_POST['idAluno']; $curso =$_POST['curso']; $mes = $_POST['mes']; $ano =$_POST['ano']; $valor= $_POST['valor'];
        $mensal = PagamntoMensalidade::query()->where('idAluno',$idAluno)->where('mes',$mes)->where('curso',$curso)->where('anoPago',$ano)->pluck('id')->toJson();
        $id =  substr($mensal,1,-1);
        $mensal2 = PagamntoMensalidade::query()->find($id);
        $mensal2->estado = 'pago';
        $mensal2->valorTotal = $mensal2->valorTotal+$valor;
        $mensal2->save();
       echo 'Actualizado com sucesso';
    }
}
