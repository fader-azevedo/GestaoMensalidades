<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Inscricao;
use App\Mensalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AlunoController extends Controller{

    private $mensalidadeController;
    private $alunoController;
    private $aluno;
    public function __construct(MensalidadeController $mensalidadeController){
        $this->mensalidadeController = $mensalidadeController;
        $this->aluno = new Aluno();
    }

    public function index(){
        $listaAluno = Aluno::all();
        return view('aluno.listar');
    }


    public function listar(Request $request){

        $al = new Aluno();
        $al->create();
    }

    public function getDisciplinasAluno(){

    }

    public function getCursosAluno(){
        $inscricao = Inscricao::query()->join('alunos','inscricaos.idAluno','=','alunos.id')
            ->join('cursos','inscricaos.idCurso','=','cursos.id')
            ->select('cursos.nome as curso','alunos.*','cursos.id as idCurso')
            ->where('idAluno',$_POST['idAluno'])->where('ano',$_POST['ano'])->get();
        return response()->json(array('dados'=>$inscricao));
    }
}
