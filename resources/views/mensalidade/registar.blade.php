@extends('template.app')
@section('menu')
    <li>
        <a href="{{url('/')}}">
            <i class="fa fa-home"></i>
            <span >Inicio</span>
        </a>
    </li>

    <li class="treeview active">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Mensalidades</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href=""><i class="fa fa-pencil"></i> Registar Mensalidade</a></li>
            <li><a href="{{'/mensalidade'}}"><i class="fa fa-list"></i> Listar Mensalidades</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Alunos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-pencil"></i> Registar</a></li>
            <li><a href=""><i class="fa fa-list"></i> Listar</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Estatísticas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-pencil"></i>Alunos</a></li>
            <li><a href=""><i class="fa fa-money"></i> Mensalidade</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-history"></i>
            <span>Históricos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-users"></i> Alunos</a></li>
            <li><a href=""><i class="fa fa-money"></i> Mensalidades</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-book"></i>
            <span>Extras</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-lock"></i> Bloquear Tela</a></li>
            <li><a href=""><i class="fa fa-list"></i> Listar</a></li>
        </ul>
    </li>
@endsection
@section('content')

    <section style="position: relative;">
        <ol class="breadcrumb">
            <li><a ><i class="fa fa-money"></i>&nbsp; Mensalidade</a></li>
            <li class="active">Registar</li>
        </ol>
    </section>
    {{--<form id="formulario">--}}
    <section class="row">
        <div  class="col-md-3 col-sm-3 col-lg-3">
            <div style="display: flex; ">
                <a style="color: #3f729b; font-size: 33px; margin-top: -5px">
                    <i class="zmdi zmdi-account-circle prefix"></i>
                </a>
                <select id="inPutAluno" class="select2">
                    <option selected="selected">Selecine o aluno</option>
                    @foreach($alu  as $a)
                        <option id="{{$a->id}}" value="{{$a->nome.' '.$a->apelido}}">{{$a->nome.' '.$a->apelido}}</option>
                    @endforeach
                </select>
            </div>

            {{--<label class="custom-file-upload">--}}
                {{--<input type="file" ><i class="fa fa-folder"></i>--}}
            {{--</label>--}}
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active">
                </div>
                <div class="widget-user-image">
                    <img id="idFotoAluno" class="img-circle" src="{!! asset('img/user.jpg') !!}" alt="">
                </div>
				
                <div class="box-footer">
                    {{--input responsavel em armazenar o valor de divida--}}
                    <input type="hidden" id="valorDivida">
                    {{--/*input responsavel por armazenar o valor a pagar de cada mensalidade*/--}}
                    <input type="hidden" id="valorAPagar">
                    {{--input de vvalor a pagar no momento de pagamento--}}
                    {{--<input type="hidden" id="valorP">--}}
                    {{--input que concebe o nome do curso--}}
                    <input type="hidden" id="nomeCurso">

                    <input type="hidden" id="mesAdiantado">
                </div>
            </div>
        </div>
		<div  class="col-sm-5 col-md-5 col-lg-5">

            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-calendar" style="color:#00b0ff;"></i>
                    <h3 class="box-title">Cursos e Meses à pagar</h3>
                </div>
                <div class="box-body">
                    <div class="row" style="margin-bottom: 0">
                        <h6 class="pull-right" style="margin-bottom: 5px; font-size: 18px">
                            <label style="width: 100px" class="label label-default">Valor</label>
                            <label style="width: 100px" class="label label-warning">Dívida</label>
                        </h6>
                    </div>

                    <ul class="todo-list" id="listCursos">
                        <li class="cr">
                            <input type="checkbox" id="demos" checked disabled>
                            <label for="demos"><span class="text">Curso</span></label>
                            <div class="pull-right">
                                <a class="label label-default">500 Mt</a>
                                <a class="label label-warning">1000 Mt</a>
                            </div>
                        </li>
                    </ul>

                    <div class="btn-app2" >
                        <label for="selectMes" class="label label-info">Selecione o(s) Mês(es)</label>
                        <select style="width: 100%"  id="selectMes" class="select2 form-control" multiple="multiple">
                        </select>
                        <span style="font-size: 14px" class="badge bg-green tooltipped" id="txtValorAPagar"    data-tooltip="Valor à Pagar">0 Mt</span>
                    </div>
                </div>
            </div>
		</div>
        <div class="col-sm-4 col-md- col-lg-4">
          
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-money" style="color:#00b0ff;"></i>
                    <h3 class="box-title">Pagamento</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label style="font-size: 15px">Tipo: &nbsp;&nbsp;</label>
                            <input id="normal" type="radio" value="Normal" checked name="tipoPay">
                            <label for="normal" >Normal</label>
                            <input id="parcial" type="radio" value="parcial" name="tipoPay">
                            <label class="pull-right" for="parcial" >Parcial&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <div style="background-color: #3f729b" class="list-seperator"></div>

                            <label style="font-size: 15px">Forma:</label>
                            <input id="numerico" type="radio" value="numerico" checked name="formaPay">
                            <label for="numerico" >Numérico</label>
                            <input id="bank" type="radio" value="deposito bancario" name="formaPay">
                            <label class="pull-right" for="bank" >Depósito</label>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div style="background-color: #3f729b" class="list-seperator"></div>
                            <div id="carouPay" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner" style="max-height: 62px">
                                    <div class="item active">
                                        <div style="display:flex;">
                                            <div class="input-field" style="margin-right: 10px">
                                                <input type="number" id="valorPayy">
                                                <label for="valorPayy">Valor entregue</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="number" value="0.0" id="valorTrocos">
                                                <label for="valorTrocos">Trocos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div style="display:flex;">
                                            <div class="input-field" style="margin-right: 10px">
                                                <input id="valor" type="number">
                                                <label for="valor">Valor</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="numRecibo" type="text">
                                                <label for="numRecibo">Número de Recibo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <form id="form1" method="post">
                        <button class="btn btn-danger">Cancelar</button>
                        <div class="pull-right">
                            <input type="hidden" id="valorP" name="valor">
                            <input type="hidden" value="numerico" name="forma">
                            <input type="hidden" value="12345" name="numrecibo">
                            <input type="hidden" value="2017-09-09 00:00:00" name="dataP">
                            <input id="butSalvar" value="Salvar" type="submit" class="btn btn-success">
                            {{--<button id="butSalvar" type="submit" class="btn btn-success" style="margin-left: 5px">&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>--}}
                        </div>
                    </form>
                </div>
            </div>
            {{--<br/>--}}
        </div>
    </section>
    <section style="position: relative;height: 3px" class="row">
        <div class="row" >
            <h6 class="centered">
                <label class="label label-success">Pago</label>
                <label class="label label-warning">Adiantado</label>
                <label class="label label-danger">Não pago</label>
            </h6>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12" style="padding-top: 0;  border-radius: 6px;  background-color:#f2f2f2;height: 35px; display: flex">
            <div class="inicio"><p style="color: #00b0ff" class="centered"><i class="fa fa-check fa-2x"></i></p></div>
            <div id="DivMeses" style=" width: 100%;display: flex">
            </div>
            <div class="fim tooltipped" data-tooltip=""><p style="color: #171eff" class="centered"><i class="fa fa-star fa-2x"></i></p></div>
        </div>
    </section>
    {{--</form>--}}
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            var valorAPagar=0;
            var idAluno=0;
            $('#inPutAluno').on('change',function () {
                var op = $('option[value="'+$(this).val()+'"]');
                idAluno = op.length ? op.attr('id'):'';
                if(idAluno === '' ||  $('#inPutAluno').val().length=== 0){
                    return;
                }
                var mesess='';
                $.ajax({
                    url: '/api/listarPorAluno',
                    type: 'POST',
                    data: {'idAluno':idAluno,'ano':2017},
                    success: function (rs) {
                        var valorMensal = rs.curso[0].valormensal;

                        document.getElementById('idFotoAluno').src = '{{asset('img/upload/')}}'.concat('/' + rs.foto);
                        $('.mes').remove();
                        $('#actual').remove();
                        $('.ms').remove();
                        /*Inicio de raking de pagamento*/
                        var mesAdiantado ='';
//                        var valorDivida=0;

                        var valorTodosMeses =0;
                        var dividasTodosMeses =0;
                        if(rs.mensal.length > 0) {
                            for (var i = 0; i < rs.mensal.length; i++) {
                                if (rs.mensal[i].mesEstado === 'pago') {
                                    $('#DivMeses').append(' <div class="mes"><label class="label label-success">' + rs.mensal[i].mes + '</label></div>');
                                    mesess += rs.mensal[i].mes + ' ' + '<i style="color: #33de0c" class="fa fa-check"></i><br/>';
                                    document.getElementById('mesAdiantado').value='';
                                } else if (rs.mensal[i].mesEstado === 'adiantado') {
                                    $('#DivMeses').append(' <div class="mes tooltippy"> <span style="color:#f39c12;" class="tooltippytext">Valor:' + ' ' + rs.mensal[i].valorTotal + ' ' + 'Mt</span> <label class="label label-warning">' + rs.mensal[i].mes + '</label></div>');
                                    mesAdiantado = rs.mensal[i].mes;
                                    mesess += rs.mensal[i].mes + ' ' + '<i style="color: #f39c12" class="fa fa-check"></i><br/>';
                                }

                                /*Cursos e respectiva divida*/
                                $('.cr').remove();
                                if (rs.curso.length === 1) {
                                    /*Quando so frequenta apenas um curso*/
                                    $('#listCursos').append('<li class="cr"> ' +
                                        '<input class="radios" id="radio' + rs.curso[0].id + '" type="checkbox" checked disabled> <label for="radio' + rs.curso[0].id + '"><span class="text">' + rs.curso[0].nome + '</span>' +
                                        '</label> ' +
                                        '<a id="cursoDivida' + rs.curso[0].id + '" style="font-size: 14px; float: right; width: 100px" class="label label-warning">' + rs.mensal[i].divida + ' Mt</a> ' +
                                        '<a style="font-size:14px; float:right; width: 100px" class="label label-default">' + rs.curso[0].valormensal.toFixed(2) + ' Mt</a> ' +
                                        '</li>');
                                    valorTodosMeses = rs.curso[0].valormensal;
                                    dividasTodosMeses = rs.mensal[i].divida;
                                    document.getElementById('nomeCurso').value =  rs.curso[0].nome ;
                                } else if ((rs.curso.length > 1)) {
                                    /*Quando faz mais de um curso*/
                                    if (rs.curso[0].nome === rs.mensal[i].curso) {

                                        $('#listCursos').append('<li class="cr"> ' +
                                            '<input name="ckeque" class="radios" id="radio' + rs.curso[0].id + '" type="checkbox" checked data-title="' + rs.curso[0].nome + '" data-valorMensal="'+rs.curso[0].valormensal.toFixed(2)+'"  data-divida="' + rs.mensal[i].divida.toFixed(2)+'">' +
                                            '<label for="radio'+rs.curso[0].id+'"><span class="text">' + rs.curso[0].nome + '</span>' +
                                            '</label>' +
                                            '<a style="font-size: 14px; float:right; width: 100px" class="label label-warning tk">' + rs.mensal[i].divida.toFixed(2) + ' Mt</a> ' +
                                            '<a style="font-size: 14px; float:right; width: 100px" class="label label-default">' + rs.curso[0].valormensal.toFixed(2) + ' Mt</a> ' +
                                            '</li>');
                                        valorTodosMeses = rs.curso[0].valormensal;
                                        dividasTodosMeses = rs.mensal[i].divida;
                                    }
                                    for (var cr = 1; cr < rs.curso.length; cr++) {
                                        /*verifica se o curso ja foi pago pelo menos uma vez*/
                                        if (rs.curso[cr].nome === rs.mensal[i].curso) {
                                            $('#listCursos').append('<li class="cr"> ' +
                                                '<input name="ckeque"  class="radios" id="radio' + rs.curso[cr].id+'" type="checkbox" data-title="' + rs.curso[cr].nome + '" data-valorMensal="'+rs.curso[cr].valormensal.toFixed(2)+'" data-divida="' + rs.mensal[i].divida.toFixed(2)+'">' +
                                                '<label for="radio' + rs.curso[cr].id + '"><span class="text">' + rs.curso[cr].nome + '</span>' + '</label>' +
                                                '<a style="font-size: 14px; float: right; width: 100px" class="label label-warning">' + rs.mensal[i].divida.toFixed(2) + ' Mt</a> ' +
                                                ' <a style="font-size: 14px; float: right; width: 100px" class="label label-default">' + rs.curso[cr].valormensal.toFixed(2) + ' Mt</a> ' +
                                                '</li>');
                                        } else {
                                            $('#listCursos').append('<li class="cr"> ' +
                                                '<input name="ckeque"  class="radios" id="radio' + rs.curso[cr].id + '" type="checkbox" data-title="' + rs.curso[cr].nome + '" data-valorMensal="'+rs.curso[cr].valormensal.toFixed(2)+'" data-divida="0">' +
                                                ' <label for="radio' + rs.curso[cr].id + '"><span class="text">' + rs.curso[cr].nome + '</span>' + '</label>' +
                                                '<a style="font-size: 14px; float: right; width: 100px" class="label label-warning"> 0.00 Mt </a> ' +
                                                '<a style="font-size: 14px; float: right; width: 100px" class="label label-default">' + rs.curso[cr].valormensal.toFixed(2) + ' Mt</a> ' +
                                                '</li>');
                                        }
                                    }
                                    document.getElementById('nomeCurso').value =  rs.curso[0].nome ;
                                }
                            }
                        }else{
                            /*caso ainda nao exista registo de pagamento*/
                            $('.cr').remove();
                            $('#listCursos').append('<li class="cr"> ' +
                                '<input id="radio' + rs.curso[0].id + '" type="checkbox" checked disabled> <label for="radio' + rs.curso[0].id + '"><span class="text">' + rs.curso[0].nome + '</span>' + '</label>' +
                                '<a style="font-size: 14px; float: right; width: 100px" class="label label-warning"> 0.00 Mt </a> ' +
                                '<a style="font-size: 14px; float: right; width: 100px" class="label label-default">' + rs.curso[0].valormensal.toFixed(2) + ' Mt</a> ' +
                                '</li>');
                            valorTodosMeses += rs.curso[0].valormensal;
                        }
                        /*Fimo do ranking de pagamento de mensalidades*/

                        /*Adicona mes adiantado no input dos mes a pagar*/
                        if(mesAdiantado !== '') {
                            $('#selectMes').append('<option selected="selected"  class="ms adiantado" value=' + mesAdiantado + '>' + mesAdiantado + '</option>');
                            document.getElementById('mesAdiantado').value =mesAdiantado;
                            $('#selectMes').append('<option  selected="selected"  class="ms" value=' + rs.mesesNao[0].nome + '>' + rs.mesesNao[0].nome + '</option>');
                        }else{
                            document.getElementById('mesAdiantado').value =rs.mesesNao[0].nome;
                            $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + rs.mesesNao[0].nome + '>' + rs.mesesNao[0].nome + '</option>');
                        }
                        document.getElementById('txtValorAPagar').innerHTML = (valorTodosMeses+dividasTodosMeses).toFixed(2) +' '+'Mt';
                        document.getElementById('valorAPagar').value = (valorTodosMeses).toFixed(2);
                        document.getElementById('valorDivida').value = (dividasTodosMeses).toFixed(2);
                        document.getElementById('valorP').value = (valorTodosMeses+dividasTodosMeses);

                        /*adiciona os restantes meses a pagar*/
                        $('#DivMeses').append('<div id="actual" class="tooltippy">' + '<p style="color:#3a5fff" class="centered"><i  class="fa fa-check fa-2x"></i></p><span class="tooltippytext">'+mesess+'</span> </div>');
                        $('#DivMeses').append('<div class="mes"><label class="label label-danger">'+rs.mesesNao[0].nome+'</label></div>');
                        for(var m=1; m < rs.mesesNao.length; m++){
                            $('#DivMeses').append(' <div class="mes"><label class="label label-danger">'+rs.mesesNao[m].nome+'</label></div>');
//                            $('#selectMes').append('<option  class="ms" value='+rs.mesesNao[m].nome+'>'+rs.mesesNao[m].nome+'</option>');
                        }
                        $('#selectMes').append('<option  class="ms" value='+rs.mesesNao[1].nome+'>'+rs.mesesNao[1].nome+'</option>');


                        $('.radios').click(function () {

                            var valorMC = parseFloat($(this).attr('data-valorMensal'));//valor Mensal do curso
                            var valorDiv = parseFloat($(this).attr('data-divida'));//valor de divida de mes
                            var curs = $(this).attr('data-title');//nome do curso
                            var box =$(this);
                            if(box.is(':checked')){
                                var grp = "input:checkbox[name='"+box.attr("name")+"']";
                                $(grp).prop("checked",false);
                                box.prop('checked',true);
                                document.getElementById('nomeCurso').value = curs;
                                $.ajax({
                                    url: '/api/getDividas',
                                    type: 'POST',
                                    data: {'idAluno': idAluno, 'curso': curs, 'ano': '2017'},
                                    success: function (rs2) {
                                        document.getElementById('txtValorAPagar').innerHTML = (valorMC+valorDiv).toFixed(2)+ ' ' + 'Mt';
                                        document.getElementById('valorAPagar').value =valorMC;
                                        document.getElementById('valorDivida').value=valorDiv;

                                        $('.mes').remove();
                                        $('#actual').remove();
                                        $('.ms').remove();
//                                        $('.adiantado').remove();
                                        mesAdiantado ='';
                                        var meses2 = '';
                                        for (var b = 0; b < rs2.mensal2.length; b++) {
                                            if (rs2.mensal2[b].mesEstado === 'pago') {
                                                $('#DivMeses').append(' <div class="mes"><label class="label label-success">' + rs2.mensal2[b].mes + '</label></div>');
                                                meses2 += rs2.mensal2[b].mes + ' ' + '<i style="color: #33de0c" class="fa fa-check"></i><br/>';
//                                                document.getElementById('mesAdiantado').value='';
                                                document.getElementById('mesAdiantado').value =rs2.mensal2[b].mes;
                                            } else if (rs2.mensal2[b].mesEstado === 'adiantado') {
                                                $('#DivMeses').append(' <div class="mes tooltippy"> <span style="color:#f39c12;" class="tooltippytext">Valor:' + ' ' + rs2.mensal2[b].valorTotal + ' ' + 'Mt</span> <label class="label label-warning">' + rs2.mensal2[b].mes + '</label></div>');
                                                meses2 += rs2.mensal2[b].mes + ' ' + '<i style="color: #f39c12" class="fa fa-check"></i><br/>';
                                                mesAdiantado = rs2.mensal2[b].mes;
                                                document.getElementById('mesAdiantado').value =rs2.mensal2[b].mes;
                                            }
                                        }
                                        if(mesAdiantado !== '') {
                                            $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + mesAdiantado + '>' + mesAdiantado + '</option>');
                                            document.getElementById('mesAdiantado').value =mesAdiantado;
//                                            alert(mesAdiantado);
                                            $('#selectMes').append('<option  selected="selected"  class="ms" value=' + rs2.situacao[0].nome + '>' + rs2.situacao[0].nome + '</option>');
                                        }else {
                                            document.getElementById('mesAdiantado').value =rs2.situacao[0].nome;
                                            $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + rs2.situacao[0].nome + '>' + rs2.situacao[0].nome + '</option>');
                                        }

                                        $('#DivMeses').append('<div id="actual" class="tooltippy">' + '<p style="color:#3a5fff" class="centered"><i  class="fa fa-check fa-2x"></i></p><span class="tooltippytext">' + meses2 + '</span> </div>');
                                        $('#DivMeses').append(' <div class="mes"><label class="label label-danger">' + rs2.situacao[0].nome + '</label></div>');
                                        for (var m = 1; m < rs2.situacao.length; m++) {
                                            $('#DivMeses').append(' <div class="mes"><label class="label label-danger">' + rs2.situacao[m].nome + '</label></div>');
                                            $('#selectMes').append('<option  class="ms" value='+rs2.situacao[m].nome+'>'+rs2.situacao[m].nome+'</option>');
                                        }
//                                        document.getElementById('mesAdiantado').value =rs2.situacao[0].nome;
                                    }
                                });
                            }else{
                                box.prop('checked',true);
                            }
                        });
                    }
                });
            });
            
            $('#selectMes').change(function () {
                var mesAdiantado = document.getElementById('mesAdiantado').value;


                var valorAPay = parseFloat(document.getElementById('valorAPagar').value);
                var numMes = $('#selectMes option:selected').length;
                var valrDivida = parseFloat(document.getElementById('valorDivida').value);
                $('.adiantado').remove();
                $('#selectMes').prepend('<option  selected="selected"  class="ms adiantado" value=' + mesAdiantado + '>' + mesAdiantado + '</option>');

                /*Sem divida*/
                if(numMes>1 && valrDivida ===0){
                    document.getElementById('txtValorAPagar').innerHTML = (valorAPay*numMes).toFixed(2)+ ' ' + 'Mt';
                    document.getElementById('valorP').value = valorAPay*numMes;
                }else if(numMes === 1 && valrDivida ===0){
                    document.getElementById('txtValorAPagar').innerHTML = (valorAPay).toFixed(2)+ ' ' + 'Mt';
                    document.getElementById('valorP').value = valorAPay;
                }

                /*com divida*/
                if(numMes>1 && valrDivida !==0){
                    document.getElementById('txtValorAPagar').innerHTML = (valorAPay*(numMes-1)+valrDivida).toFixed(2)+ ' ' + 'Mt';
                    document.getElementById('valorP').value = (valorAPay*(numMes-1)+valrDivida);
                }else if(numMes === 1 && valrDivida !==0){
                    document.getElementById('txtValorAPagar').innerHTML = (valrDivida).toFixed(2)+ ' ' + 'Mt';
                    document.getElementById('valorP').value = (valrDivida);
                }
                document.getElementById('valorTrocos').value = 0.00;
            });

            $('#bank').click(function () {
                $('#carouPay').carousel(1);
            });

            $('#numerico').click(function () {
                $('#carouPay').carousel(0);
            });

            $('#valorPayy').on('input',function () {

                var vl = $(this).val();
                var valorP = parseFloat(document.getElementById('valorP').value);
                if(vl-valorP >= 0){
                    document.getElementById('valorTrocos').value = (vl-valorP).toFixed(2);
                }else{
                    document.getElementById('valorTrocos').value ='';
                }
            });

            $('#form1').submit(function () {
                $.ajax({
                    url: '/api/pagar',
                    type: 'POST',
//                    data: {'valor': valorAPagar, 'dataP': '2017-12-30 00:00:00'},
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache:false
                }).done(function (e) {
                    alert(e.dado);
                }).fail(function () {
                    alert('Erro No Metodo do Ajax ...');
                });
            })


//            $('#butSalvar').click(function () {
//                var meses = $('#selectMes').val();
//                var valorAPagar = parseFloat(document.getElementById('valorP').value);
//                var valorDivida = parseFloat(document.getElementById('valorDivida').value);
//                var curso = document.getElementById('nomeCurso').value;
//                var tipoPay = document.querySelector('input[name="tipoPay"]:checked').value;
//                var formaPay = document.querySelector('input[name="formaPay"]:checked').value;
////                alert('Meses: '+meses+'  Taku:'+valorAPagar+'  Divida:'+valrDivida+'  idAluo:'+idAluno+' curso:'+curso+'  tipo:'+tipoPay+'  forma:'+formaPay);

                /*salvar apenas pagamento*/



//                for(var c=0; c< meses.length; c++){
//
//                    if(valorDivida !== 0){
//                        /*Para fechar(actualizar) o valor que alun esta a dever*/
//                        alert('Adciona '+valorDivida+' No '+meses[0]);
//                        valorAPagar = valorAPagar-valorDivida;
//                        valorDivida =0;
////                        $.ajax({
////                            url: '/api/getDividas',
////                            type: 'POST',
////                            data: {'idAluno': idAluno, 'curso': curs, 'ano': '2017'},
////                            success: function (rs) {
////                            }
////                        });
//                    }else{
//                        alert('salva'+ meses[c]+' com:'+valorAPagar);
//                    }
//                }
//                $('#formulario')[0].reset();
//            })
        })
    </script>
@endsection