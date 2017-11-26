<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="css/export.css">
</head>

<body>
<h2>Extrato do Aluno</h2>
    <h4>Nome: {{$nome}}</h4>
    <h4>Curso: {{$curso}} &nbsp;&nbsp; Ano:{{$ano}}</h4>
<table border="1" style="min-height: 600px">
    <thead>
    <tr>
        <th>Mes</th>
        <th>Data de Pagamento</th>
        <th>Estado</th>
        <th>Valor Pago</th>
    </tr>
    </thead>

    <?php $total =0.0?>
    <tbody>

    @foreach($mensalidade as $ms)
        @if($ms->curso === $curso)
        <tr>
            <td> {{$ms->mes}}</td>
            <td> {{$ms->created_at}}</td>
            <td> {{$ms->estado}}</td>
            <?php $total += $ms->valorTotal?>
            <td> {{number_format($ms->valorTotal,2).' Mt'}}</td>
        </tr>
        @endif
    @endforeach

    @foreach($mesNaoPagas as $m)
        <tr>
            <td> {{$m->nome}}</td>
            <td>---------------</td>
            <td>---------------</td>
            <td>---------------</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h3>Total: <?php echo number_format($total,2) ?>&nbsp;Mt</h3>
<h4 style="text-align: center;"><?php echo date('d/m/Y').' - '?>Sistema de Controlo de Mensalidades</h4>
</body>
</html>
