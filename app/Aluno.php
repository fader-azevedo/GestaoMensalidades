<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aluno extends Model{

    protected $fillable =[
      'id', 'apelido', 'nome','sexo', 'tipoDoc','numDoc','foto','idEncarregado','iduser'
    ];

    public function getAluno(){
        return DB::table('alunos')->get();
    }

    public function getAlunoByID($id){
        return DB::table('alunos')->find($id);
    }


}
