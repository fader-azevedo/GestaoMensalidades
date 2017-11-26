<?php

namespace App\Http\Controllers;

use App\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller{

    public function salvarPagamento(Request $request){
        $pagamento = new Pagamento();
        $pagamento = $pagamento->create($request->all());

        echo $pagamento->id;
    }
}
