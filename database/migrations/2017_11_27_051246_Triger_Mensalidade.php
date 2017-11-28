<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrigerMensalidade extends Migration{

    public function up(){
        DB::unprepared('
            CREATE TRIGGER trg_Mensalidade AFTER UPDATE ON `pagamnto_mensalidades` FOR EACH ROW
            BEGIN
                INSERT INTO `mensalidade_adiantada` (`valorAntigo`,`valorNovo`,`valorTotal`, `idAluno`,`mes`,`ano`,`curso`) VALUES (OLD.valorTotal,NEW.valorTotal-OLD.valorTotal,OLD.valorTotal+NEW.valorTotal-OLD.valorTotal, OLD.idAluno, OLD.mes, OLD.anoPago, OLD.curso);
            END '
        );
    }

    public function down(){
        DB::unprepared('DROP TRIGGER `trg_Mensalidade`');
    }
}

