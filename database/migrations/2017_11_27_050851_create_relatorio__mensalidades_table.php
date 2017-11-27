<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatorioMensalidadesTable extends Migration{

    public function up(){
        Schema::create('mensalidade_adiantada', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valorAntigo');
            $table->double('valorNovo');
            $table->integer('idAluno');
            $table->string('mes');
            $table->integer('ano');
            $table->string('curso');
        });
    }

    public function down(){
        Schema::dropIfExists('mensalidade_adiantada');
    }
}
