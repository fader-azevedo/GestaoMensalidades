<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagamntoMensalidade extends Model{
    protected $table ='pagamnto_mensalidades';
    protected $fillable =[
        'id','valorTotal','estado','mes','anoPago','idMensalidade','idPagamento','idAluno','curso'
    ];

}
