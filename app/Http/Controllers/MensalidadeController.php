<?php

namespace App\Http\Controllers;
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
//        $valor = $_POST['valor'];
//        $data = $_POST['dataP'];
//

//        $s = new Pagamento();
//        $s->create();
//
//        $al = new Aluno();
//        $al->create();

//        $pg = Pagamento::query();
//        $pg->valor = $request->valor;
//        $pg->forma = $request->forma;
//        $pg->numrecibo = $request->numrecibo;
//        $pg->dataP = $request->dataP;

//        $pg->saveOrFail();
//        $s->create($request->all());

//        try{
////            $telefone->save();
//            $p = new Pagamento();
//            $p = $p::query()->create($request->all());
//        }catch (Exception $e){
//            return "Erro ".$e->getMessage();
//        }



//        $p->save1($arr);

        return response()->json(array('dado'=>$request->valor));

//        Pagamento::query()->create($p)
    }


    public function index(){
        $alunos = Aluno::all();
        $mesesPagos = $this->getMesesPagos($this->anoDefido);
        $mesesAPagar = $this->getMesAPagar($this->anoDefido);
        $anosPay = $this->anos;
        return view('mensalidade.listar',['valorMensal'=>$this->valorMensal,'valorTotal'=>$this->valorTotal, 'alu'=>$alunos,'numAlunos'=>$this->numAlunos,'anos'=>$anosPay,'mesesPagos'=>$mesesPagos,'mesesAPagar'=>$mesesAPagar,'intervalo'=>$this->intervalo]);
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
        $alun = Aluno::query()->where('id',$_POST['idAluno'])->first();
//        $alun = Aluno::cr;
        $mensalidade = PagamntoMensalidade::query()
//            ->join('mensalidades','pagamnto_mensalidades.idMensalidade','=','mensalidades.id')
            ->join('pagamentos','pagamnto_mensalidades.idPagamento','=','pagamentos.id')
            ->join('alunos','pagamnto_mensalidades.idAluno','=','alunos.id')
//            ->select('mensalidades.estado as mesEstado','alunos.*','mensalidades.*','pagamentos.*','pagamnto_mensalidades.*')
            ->select('pagamnto_mensalidades.estado as mesEstado','alunos.*','pagamentos.*','pagamnto_mensalidades.*')
            ->where('idAluno',$_POST['idAluno'])->where('anoPago',$_POST['ano'])->get();

        $this->valorMensal =40;
        /*Para registo de mensalidade*/
        $mesesPagos = '';
        $def = Def_Mensalidade::query()->join('mes','def__mensalidades.mescomeco','=','mes.numero')->select('mes.*','def__mensalidades.mesfim')->where('ano',$_POST['ano'])->first();
        foreach ($mensalidade as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
        $mesNaoP = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();
        $inscricao = Inscricao::query()
            ->join('alunos','inscricaos.idAluno','=','alunos.id')
            ->join('cursos','inscricaos.idCurso','=','cursos.id')
            ->select('cursos.*','cursos.id as idCurso')
            ->where('idAluno',$_POST['idAluno'])->where('ano',$_POST['ano'])->get();
//        $divida = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])
//            ->where('anoPago',$_POST['ano'])->sum('divida');
        return  response()->json(array('mensal'=> $mensalidade,'foto'=>$alun->foto,'mesesNao'=>$mesNaoP,'curso'=>$inscricao/*,'divida'=>$divida*/));
    }




    public function registarMensalidade(){
        $aluno = Aluno::all();
        return view('mensalidade.registar',['alu'=>$aluno,'valorMensal'=>$this->valorMensal,'valorTotal'=>$this->valorTotal]);
    }

    public function getDevedoresMes(){

        $tabela =$_POST['tabela'];
        $export =$_POST['tipo'];
//        $idAlunos = PagamntoMensalidade::query()->join('mensalidades','pagamnto_mensalidades.idMensalidade','=','mensalidades.id')->select('idAluno')->where('mes',$_POST['mes'])->get();
        $idAlunos = PagamntoMensalidade::query()->select('idAluno')->where('mes',$_POST['mes'])->get();
        $ids='';
        foreach ($idAlunos as $i){
            $ids = $i->idAluno.' '.$ids;
        }
        $arrayIds = explode(' ',trim(rtrim($ids)));

        $devedores = Inscricao::query()
            ->join('alunos','alunos.id','=','inscricaos.idAluno')
            ->join('cursos','cursos.id','=','inscricaos.idCurso')
            ->join('turmas','turmas.idCurso','=','inscricaos.idCurso')
            ->select('alunos.nome as nomeAluno','alunos.*','cursos.nome as curso','cursos.valormensal as divida','turmas.nome as turma')
        ->whereNotIn('inscricaos.idAluno',$arrayIds)->where('inscricaos.ano','=',$_POST['ano'])->get();

        $naddevedores = Inscricao::query()
            ->join('alunos','alunos.id','=','inscricaos.idAluno')
            ->join('cursos','cursos.id','=','inscricaos.idCurso')
            ->join('turmas','turmas.idCurso','=','inscricaos.idCurso')
            ->select('alunos.nome as nomeAluno','alunos.*','cursos.nome as curso','cursos.valormensal as divida','turmas.nome as turma')
        ->whereIn('inscricaos.idAluno',$arrayIds)->where('inscricaos.ano','=',$_POST['ano'])->get();

        if($tabela === 'devedor' && $export === 'naoModal'){
            return response()->json(array('devedor'=>$devedores));
        }elseif ($tabela === 'naodevedor' && $export ==='naoModal'){
           return response()->json(array('naodevedor'=>$naddevedores));
        }


        if($tabela === 'todasTabelas' && $export === 'simModel'){
            return view('mensalidade.modal',['devedores'=>$devedores,'honestos'=>$naddevedores,'mes'=>$_POST['mes']]);
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

    public function getDividas(){
//        $divida = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])
//            ->where('curso',$_POST['curso'])->sum('divida');


        $mensalidade = PagamntoMensalidade::query()
//            ->join('mensalidades','pagamnto_mensalidades.idMensalidade','=','mensalidades.id')
            ->select('pagamnto_mensalidades.estado as mesEstado','pagamnto_mensalidades.*')
            ->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->where('anoPago',$_POST['ano'])->get();

        $mesesPagos = '';
        $def = Def_Mensalidade::query()->join('mes','def__mensalidades.mescomeco','=','mes.numero')->select('mes.*','def__mensalidades.mesfim')->where('ano',$_POST['ano'])->first();
        foreach ($mensalidade as $ms){$mesesPagos = $mesesPagos.' '.$ms->mes;}
        $mesNaoP = Mes::query()->select('nome')->whereNotIn('nome',explode(' ',trim(rtrim($mesesPagos))))->where('numero','>=',$def->numero)->where('numero','<=',$def->mesfim)->get();

//        $mensalidade = PagamntoMensalidade::query()->where('idAluno',$_POST['idAluno'])->where('curso',$_POST['curso'])->select('idMensalidade')->get();
        return response()->json(array('situacao'=>$mesNaoP,'mensal2'=>$mensalidade));
    }




//    public function update(Request $request){
//        $this->pessoa = ($this->pessoa->find($request->pessoaId));
//        $this->pessoa->update($request->all());
//        return redirect('/');
//    }

}
