<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8"/>
        <style>
            td{
                margin: -5px;
            }
            table{
                margin-left: -20px;
            }
        </style>
        <link type="text/css" rel="stylesheet" href="css/export.css">
    </head>

    <body>
        <h2>Alunos Devedores & Não Devedores</h2>
        <h3>{{$mesAno}}</h3>
        <table border="2" style="width: 104%" id="tabelaAll">
            <thead>
            <tr>
                <th style="width: 15%"></th>
                <th style="width: 30%">Nome</th>
                <th style="width: 30%">Curso-Turma</th>
                <th style="width: 10%">Dívida/Valor Pago</th>
                <th style="width: 15%">Total</th>
            </tr>
            </thead>
            <tbody id="tabeAllCorpo">
            <?php $totalDivida=0.0; $totalPago=0.0 ?>
            <tr>
                <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px">Devedores</td>
                <td >

                    @for($d =0 ; $d < $vezes ; $d++)
                        <p class="myP">{{$devedores[$d]->nomeAluno.' '.$devedores[$d]->apelido}}</p>
                    @endfor
                </td>
                <td>
                    @for($d =0 ; $d < $vezes ; $d++)
                        <p class="myP">{{$cursos[$d].' - '. @substr($turma[$d],2,-2)}} </p>
                    @endfor
                </td>

                <td >
                    @for($d =0 ; $d < $vezes ; $d++)
                        <?php $totalDivida+= substr($valor[$d],1,-1)?>
                        <p class="myP">{{ @number_format(@substr($valor[$d],1,-1),2).' Mt'}} </p>
                    @endfor
                </td>

                <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px"><?php echo number_format($totalDivida,2).' Mt'?></td>
            </tr>
            <tr>
                <td style="height: 110px; border: 2px solid #89ccdf; font-size: 25px">Não Devedores</td>
                <td >
                    @foreach($honestos as $dev)
                        <p class="myP">{{$dev->nomeAluno.' '.$dev->apelido}}</p>
                    @endforeach
                </td>
                <td class="myPDady" >
                    @foreach($honestos as $dev)
                        <p class="myP">{{$dev->curso.' - '.$dev->turma}} </p>
                    @endforeach
                </td>
                <td >
                    @foreach($honestos as $dev)
                        <?php $totalPago += $dev->valor?>
                        <p class="myP">{{number_format($dev->valor,2).' Mt'}} </p>
                    @endforeach
                </td>
                <td style="height: 110px;  font-size: 25px"><?php echo number_format($totalPago,2).' Mt'?></td>
            </tr>
            </tbody>
        </table>
        <h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
    </body>
</html>