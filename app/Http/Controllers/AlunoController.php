<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Contacto;
use App\Def_Mensalidade;
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
        $anos = Def_Mensalidade::query()->pluck('ano');
        $listaAluno = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()->select('alunos.*')->where('estado','=','inscrito')->get();
        return view('aluno.listar',compact('listaAluno','anos'));
    }


    public function listar(Request $request){

        $al = new Aluno();
    }

    public function getContacto(){
        $contacto = Contacto::query()->find($_POST['id']);
    }

}
