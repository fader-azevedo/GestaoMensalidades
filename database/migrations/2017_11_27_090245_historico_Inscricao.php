<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoricoInscricao extends Migration{

    public function up(){
        Schema::create('historico_Inscricao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAluno');
            $table->string('estado');
            $table->integer('ano');
            $table->integer('idCurso');
        });
    }

    public function down(){
        Schema::dropIfExists('historico_Inscricao');
    }
}
