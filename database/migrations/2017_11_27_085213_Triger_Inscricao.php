<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrigerInscricao extends Migration{
    public function up(){
        DB::unprepared('
            CREATE TRIGGER trg_Inscricao AFTER UPDATE ON `inscricaos` FOR EACH ROW
            BEGIN
                INSERT INTO `historico_Inscricao` (`idAluno`,`estado`,`ano`,`idCurso`) VALUES (OLD.idAluno, NEW.estado, OLD.ano, OLD.idCurso);
            END '
        );
    }

    public function down(){
        DB::unprepared('DROP TRIGGER `trg_Inscricao`');
    }
}
