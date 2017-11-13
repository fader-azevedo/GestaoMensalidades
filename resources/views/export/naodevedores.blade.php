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
            </tr>
            </thead>

            <tbody>
                @foreach($dados as $alu)
                    <tr>
                        <td>{{$alu->nomeAluno.' '.$alu->apelido}}</td>
                        <td>{{$alu->turma}}</td>
                        <td>{{$alu->curso}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
    </body>
</html>