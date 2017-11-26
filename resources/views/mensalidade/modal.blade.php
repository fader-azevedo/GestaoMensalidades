
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><i class="li_calendar"></i>&nbsp;{{$mes}}</h4>
    <input id="inputMes" type="hidden" value="{{$mes}}">
</div>
<div class="modal-body" >

    <div class="btn-group pull-right" style="margin-bottom: 10px">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clipboard"></i>&nbsp;Exportar
            <span class="caret"></span>
            <span class="sr-only"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a style="cursor: pointer;" id="ExportExcelAll"><i style="color: green" class="fa fa-file-excel-o"></i>Excel</a></li>
            <li class="divider"></li>
            <li><a style="cursor: pointer;" id="ExportPdfAll"><i style="color: red" class="fa fa-file-pdf-o"></i>Pdf</a></li>
        </ul>
    </div>

    <table border="2" style="width: 100%;" id="tabelaAll">
        <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Curso-Turma</th>
            <th>Dívida/Valor Pago</th>
            <th>Total</th>
        </tr>
        </thead>
        {{--'cursos'=>$listaCursos,'vezes'=>$numNaoPagamento,'turma'=>$listaDeTurma,'valor'=>$listaDeValor--}}
        <tbody id="tabeAllCorpo">
        <?php $totalDivida=0.0; $totalPago=0.0 ?>
        <tr>
            <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px">Devedores</td>
            <td style="border: 2px solid #89ccdf">

                @for($d =0 ; $d < $vezes ; $d++)
                    <p class="myP">{{$devedores[$d]->nomeAluno.' '.$devedores[$d]->apelido}}</p>
                @endfor
            </td>
            <td style="border: 2px solid #89ccdf">
                @for($d =0 ; $d < $vezes ; $d++)
                <p class="myP">{{$cursos[$d].' - '. @substr($turma[$d],2,-2)}} </p>
                @endfor
            </td>

            <td style="border: 2px solid #89ccdf">
                @for($d =0 ; $d < $vezes ; $d++)
                    <?php $totalDivida+= substr($valor[$d],1,-1)?>
                <p class="myP">{{ @number_format(@substr($valor[$d],1,-1),2).' Mt'}} </p>
                @endfor
            </td>

            <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px"><?php echo number_format($totalDivida,2).' Mt'?></td>
        </tr>
        <tr>
            <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px">Não Devedores</td>
            <td style="border: 2px solid #89ccdf">
                @foreach($honestos as $dev)
                    <p class="myP">{{$dev->nomeAluno.' '.$dev->apelido}}</p>
                @endforeach
            </td>
            <td class="myPDady" style="border: 2px solid #89ccdf">
                @foreach($honestos as $dev)
                    <p class="myP">{{$dev->curso.' - '.$dev->turma}} </p>
                @endforeach
            </td>
            <td style="border: 2px solid #89ccdf">
                @foreach($honestos as $dev)
                    <?php $totalPago += $dev->valor?>
                    <p class="myP">{{number_format($dev->valor,2).' Mt'}} </p>
                @endforeach
            </td>
            <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px"><?php echo number_format($totalPago,2).' Mt'?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
    {{--<button type="button" class="btn btn-outline" id="imprimir">Impimir</button>--}}
</div>
<script>
    var ano = document.getElementById('selectAno').value;
    $('#ExportPdfAll').click(function () {
        var mes = document.getElementById('inputMes').value;
        window.location ='/exportDevedoresPDF?mes='+mes+'&ano='+ano+'&tabela=todos';
    });

    $('#ExportExcelAll').click(function () {
        $('#tabelaAll').tableExport({type:'excel',escape:'false'});
    })
</script>