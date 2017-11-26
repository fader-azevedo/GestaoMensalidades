<?php

namespace App\Http\Controllers;

use App\Inscricao;
use Illuminate\Http\Request;

class InscricaoController extends Controller{

    public function getInscricao(){
        $inscricao = Inscricao::query()
            ->join('alunos','inscricaos.idAluno','=','alunos.id')
            ->join('cursos','inscricaos.idCurso','=','cursos.id')
            ->join('contactos','alunos.idContacto','=','contactos.id')
            ->select('cursos.*','cursos.nome as curso','cursos.id as idCurso','alunos.foto as picture','alunos.*','contactos.*')
            ->where('idAluno',$_POST['idAluno'])->where('ano',$_POST['ano'])->get();
        return  response()->json(array('inscricao'=>$inscricao));
    }


}
