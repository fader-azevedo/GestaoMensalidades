<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Inscricao;
use App\PagamntoMensalidade;
use App\TurmaAluno;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ExportController extends Controller{

    private $tabela;
    private $mesAno;
    private $idAlunoInscritos ;
    private $listaCursos=array();
    private $listaIdsAlunos = array();
    private $listaDeTurma = array();
    private $listaDeValor=array();
    private $numNaoPagamento=0;
    private $devedores;
    private $naoDevedores;

    public function __construct(){
//        $this->tabela =$_GET['tabela'];
//        $this->mesAno = $_GET['mes'].'-'.$_GET['ano'];
        $this->mesAno = $_POST['mes'].'-'.$_POST['ano'];

        $this->idAlunoInscritos = Inscricao::query()->where('estado','=','inscrito')->distinct()->pluck('idAluno')->toArray();
        sort($this->idAlunoInscritos);

        $this->numNaoPagamento=0;

        for ($c =0; $c< sizeof($this->idAlunoInscritos); $c++){
            $cursosAlunoo = Inscricao::query()->join('alunos','alunos.id','=','inscricaos.idAluno')->join('cursos','cursos.id','=','inscricaos.idCurso')
                ->where('inscricaos.idAluno','=',$this->idAlunoInscritos[$c])->pluck('cursos.nome')->toArray();

            for ($k =0; $k< sizeof($cursosAlunoo); $k++){
                $resultado = PagamntoMensalidade::query()->where('idAluno','=',$this->idAlunoInscritos[$c])->where('curso','=',$cursosAlunoo[$k])->where('mes','=',$_POST['mes'])->get();
                if($resultado->isEmpty()){
                    $this->numNaoPagamento +=1;
                    array_push($this->listaIdsAlunos,$this->idAlunoInscritos[$c]);
                    array_push($this->listaCursos,$cursosAlunoo[$k]);

                    /*Burca a determinada turma do aluno*/
                    $turma = TurmaAluno::query()->join('turmas','turmas.id','=', 'turma_alunos.idTurma')
                        ->where('turma_alunos.idAluno','=',$this->idAlunoInscritos[$c])
                        ->where('turmas.nomeCurso','=',$cursosAlunoo[$k])->pluck('turmas.nome');
                    array_push($this->listaDeTurma,$turma);

                    /*busca o valor de Mensalidade */
                    $valor = Curso::query()->where('nome','=',$cursosAlunoo[$k])->pluck('valormensal');
                    array_push($this->listaDeValor, $valor);
                }
            }
        }
        $this->devedores = Inscricao::query()->join('alunos','alunos.id','=','inscricaos.idAluno')->select('alunos.nome as nomeAluno','alunos.*')->whereIn('inscricaos.idAluno',$this->listaIdsAlunos)->get();
        $this->naoDevedores = PagamntoMensalidade::query()->join('alunos','alunos.id','=','pagamnto_mensalidades.idAluno')->join('turmas','turmas.nomeCurso','=','pagamnto_mensalidades.curso')->select('alunos.nome as nomeAluno','alunos.*','turmas.nome as turma','turmas.nomeCurso as curso','pagamnto_mensalidades.valorTotal as valor','pagamnto_mensalidades.mes','pagamnto_mensalidades.idAluno')->where('mes',$_POST['mes'])->where('anoPago',$_POST['ano'])->get();
    }

    public function exportarNaoDevedores(){
        $pdf = PDF::loadView('export.naodevedores',['dados'=>$this->naoDevedores,'mesAno'=>$this->mesAno]);
        return $pdf->download('naoDevedores_'.$this->mesAno.'.pdf');
    }

    public function exportarDevedores(){
        $pdf = PDF::loadView('export.devedores',['devedores'=>$this->devedores,'mesAno'=>$this->mesAno,'cursos'=>$this->listaCursos,'turma'=>$this->listaDeTurma,'vezes'=>$this->numNaoPagamento,'valor'=>$this->listaDeValor]);
        return $pdf->download('devedores_'.$this->mesAno.'.pdf');
    }

    public function exportarAll(){
        $pdf = PDF::loadView('export.devsenao',['devedores'=>$this->devedores,'honestos'=>$this->naoDevedores,'mesAno'=>$this->mesAno,'cursos'=>$this->listaCursos,'turma'=>$this->listaDeTurma,'vezes'=>$this->numNaoPagamento,'valor'=>$this->listaDeValor]);
        return $pdf->download('devs&NaoDevs_'.$this->mesAno.'.pdf');
    }
}
