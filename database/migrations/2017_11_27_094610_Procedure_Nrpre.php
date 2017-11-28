<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcedureNrpre extends Migration{

    public function up(){
        DB::unprepared('
            CREATE PROCEDURE Nrpre()
            BEGIN

            SELECT count(*) FROM inscricaos where estado = pre-inscrito;
            END'
        );
    }

    public function down(){
        DB::unprepared('DROP  PROCEDURE `Nrpre`');
    }
}
