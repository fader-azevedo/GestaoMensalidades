<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8"/>
        <link type="text/css" rel="stylesheet" href="css/export.css">
    </head>

    <body>
        <h2>Alunos Devedores</h2>
        <h3>{{$mesAno}}</h3>

        <table style="min-height: 600px">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th>Curso</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <?php $total =0.0?>
            <tbody>

                @for($d =0; $d<$vezes; $d++)
                    <tr>
                        <td> {{$devedores[$d]->nomeAluno.' '.$devedores[$d]->apelido}}</td>
                        <td> {{@substr($turma[$d],2,-2)}}</td>
                        <td> {{$cursos[$d]}}</td>
                        <td> {{@number_format(@substr($valor[$d],1,-1),2).' Mt'}}</td>
                        <?php $total+= substr($valor[$d],1,-1)?>
                    </tr>
                @endfor
            </tbody>
        </table>
        <h3>Total: <?php echo number_format($total,2) ?>&nbsp;Mt</h3>
        <h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
    </body>
</html>