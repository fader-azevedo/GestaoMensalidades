<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Disciplina;
use App\Inscricao;
use App\Mensalidade;
use App\Mes;
use App\PagamntoMensalidade;
use App\Turma;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function index(){
        $numMensal = Mensalidade::all()->count();
        $numAluno = Aluno::all()->count();
        $numDisc = Disciplina::all()->count();
        $numCuro = Curso::all()->count();
        $numTurma = Turma::all()->count();

        $alunnosInscritos = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()
            ->select('alunos.*')->where('estado','=','inscrito')->count();

        $alunosPreIn = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()
            ->select('alunos.*')->where('estado','<>','inscrito')->count();

//        $meses = Mes::all();
//        $ms = response()->json(array($meses));

        return view('template.home',['preIns'=>$alunosPreIn,'numMensal'=>$numMensal, 'numAlunos' => $alunnosInscritos,'numDisc'=>$numDisc,'numCursos'=>$numCuro,'numTurma'=>$numTurma]);
    }

    public function getNotification(){
        $alunosPreIn = Inscricao::query()->
        join('alunos','inscricaos.idAluno','=','alunos.id')->distinct()
            ->select('alunos.*')->where('estado','<>','inscrito')->count();

        return $alunosPreIn;
    }

    public function wel(){
        return view('welcome');
    }

    public function graficoMensalidade(){
        $ano = date('Y');
//        $numAlunosIncritos = Aluno::all()->count();
        $numAlunosIncritos = Inscricao::query()->where('estado','=','inscrito')->count();
//        $mensalidade = PagamntoMensalidade::query()->where('anoPago',$ano)->groupBy('mes')->orderBy('id','ASC')
//        ->get([DB::raw('mes'),DB::raw('COUNT(*) as naoDevs'), DB::raw($numAlunosIncritos.' - COUNT(*) as devs')]);

        $mensalidade = PagamntoMensalidade::query()->select([DB::raw('mes'),DB::raw('COUNT(*) as naoDevs'), DB::raw($numAlunosIncritos.' - COUNT(*) as devs')])
            ->where('anoPago',$ano)->groupBy('mes')->get();

        $numDevs=0; $numNaoDevs=0;
        foreach ($mensalidade as $md){
            $numNaoDevs +=$md->naoDevs;
            $numDevs+=$md->devs;
        }

        return $mensalidade->toJson().'$&'.$numNaoDevs.'$&'.$numDevs;
    }


    public function lock(){
        return view('template.lock');
    }

    public function logon(){
        return view('template.logon');
    }
}
