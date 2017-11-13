<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8"/>
        <link type="text/css" rel="stylesheet" href="css/export.css">
    </head>

    <body>
        <h2>Alunos Devedores & Não Devedores</h2>
        <h3>{{$mesAno}}</h3>
        <table border="2" style="width: 100%" id="tabelaAll">
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
                <td style="height: 110px; border: 2px solid #89ccdf; font-size: 20px">Devedores</td>
                <td style="border: 1px solid #89ccdf">
                    @foreach($devedores as $dev)
                        <p class="myP">{{$dev->nomeAluno.' '.$dev->apelido}}</p>
                    @endforeach
                </td>
                <td style="border: 1px solid #89ccdf">
                    @foreach($devedores as $dev)
                        <p class="myP">{{$dev->curso.' - '.$dev->turma}} </p>
                    @endforeach
                </td>

                <td style="border: 1px solid #89ccdf">
                    @foreach($devedores as $dev)
                        <?php $totalDivida+=$dev->divida?>
                        <p class="myP">{{$dev->divida.' Mt'}} </p>
                    @endforeach
                </td>
                <td style="height: 110px; border: 2px solid #89ccdf; font-size: 20px"><?php echo $totalDivida.' Mt'?></td>
            </tr>

            <tr>
                <td style="min-height: 110px; border: 2px solid #89ccdf; font-size: 20px">Não Devedores</td>
                <td style="border: 1px solid #89ccdf">
                    @foreach($honestos as $dev)
                        <p class="myP">{{$dev->nomeAluno.' '.$dev->apelido}}</p>
                    @endforeach
                </td>
                <td class="myPDady" style="border: 1px solid #89ccdf">
                    @foreach($honestos as $dev)
                        <p class="myP">{{$dev->curso.' - '.$dev->turma}} </p>
                    @endforeach
                </td>
                <td style="border: 1px solid #89ccdf">
                    @foreach($honestos as $dev)
                        <?php $totalPago += $dev->divida?>
                        <p class="myP">{{$dev->divida.' Mt'}} </p>
                    @endforeach
                </td>
                <td style="height: 110px; border: 1px solid #89ccdf; font-size: 20px"><?php echo $totalPago.' Mt'?></td>
            </tr>
            </tbody>
        </table>
        <h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
    </body>
</html>