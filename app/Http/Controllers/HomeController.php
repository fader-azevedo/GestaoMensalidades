<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Disciplina;
use App\Mensalidade;
use App\Mes;
use App\PagamntoMensalidade;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function index(){
        $numMensal = Mensalidade::all()->count();
        $numAluno = Aluno::all()->count();
        $numDisc = Disciplina::all()->count();
        $numCuro = Curso::all()->count();

//        $meses = Mes::all();
//        $ms = response()->json(array($meses));

        return view('template.home',['numMensal'=>$numMensal, 'numAlunos' => $numAluno,'numDisc'=>$numDisc,'numCursos'=>$numCuro]);
    }

    public function wel(){
        return view('welcome');
    }

    public function graficoMensalidade(){
        $ano = date('Y');
        $numAluno = Aluno::all()->count();
        $ok =0;
        $mensalidade = PagamntoMensalidade::query()->where('anoPago',$ano)->groupBy('mes')
        ->get([DB::raw('mes'),DB::raw('COUNT(*) as naoDevs'), DB::raw($numAluno.' - COUNT(*) as devs')]);

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
