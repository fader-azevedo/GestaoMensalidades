<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8"/>
        <link type="text/css" rel="stylesheet" href="css/export.css">
    </head>

    <body>
        <h2>Alunos Não Devedores</h2>
        <h3>{{$mesAno}}</h3>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Turma</th>
                <th>Curso</th>
                <th>Valor Pago</th>
            </tr>
            </thead>
            <?php $total =0.0?>
            <tbody>
                @foreach($dados as $alu)
                    <tr>
                        <td>{{$alu->nomeAluno.' '.$alu->apelido}}</td>
                        <td>{{$alu->turma}}</td>
                        <td>{{$alu->curso}}</td>
                        <td>{{@number_format($alu->valor,2).' Mt'}}</td>
                        <?php $total+= $alu->valor?>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total: <?php echo number_format($total,2) ?>&nbsp;Mt</h3>
        <h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
    </body>
</html>