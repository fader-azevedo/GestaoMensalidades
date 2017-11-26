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
            <li><a href=""><i class="fa fa-pencil"></i> Registar Alunos</a></li>
            <li><a href="{{'/aluno'}}"><i class="fa fa-list"></i> Listar Alunos</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a>
            <i class="fa fa-folder"></i>
            <span>Cursos</span>
        </a>
    </li>

    <li class="treeview ">
        <a>
            <i class="fa fa-book"></i>
            <span>Disciplinas</span>
        </a>
    </li>

    <li class="treeview">
        <a>
            <i class="fa fa-list"></i>
            <span>Turmas</span>
        </a>
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
            <div class="box box-widget widget-user" >
                <div class="widget-user-header bg-aqua-active">
                </div>
                <div class="widget-user-image" id="divFoto">
                    <img id="idFotoAluno" class="img-circle" src="{!! asset('img/user.jpg') !!}" alt="">
                    <input type="hidden" id="fotoCaminho">
                </div>
				
                <div class="box-footer">
                    {{--input responsavel em armazenar o valor de divida--}}
                    <input type="hidden" id="valorDivida">
                    {{--/*input responsavel por armazenar o valor a pagar de cada mensalidade*/--}}
                    {{--input de vvalor a pagar no momento de pagamento--}}
                    {{--<input type="hidden" id="valorP">--}}
                    {{--input que concebe o nome do curso--}}

                    <input type="hidden" id="mesAdiantado">
                </div>
            </div>
        </div>
		<div  class="col-sm-5 col-md-5 col-lg-5">

            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-calendar" style="color:#00b0ff;"></i>
                    <h3 class="box-title">Cursos e Meses à pagar</h3>
                </div>
                <div class="box-body">
                    <div class="row" style="margin-bottom: 0">
                        <h6 class="pull-right" style="margin-bottom: 5px; font-size: 18px">
                            <label style="width: 100px" class="label label-warning hidden" id="labelAdiantado">Valor Adiantado</label>
                            <label style="width: 100px" class="label label-default">&nbsp;&nbsp;Valor Mensal</label>
                        </h6>
                    </div>

                    <ul class="todo-list" id="listCursos">
                        <li class="cr">
                            <input type="checkbox" id="demos" checked disabled>
                            <label for="demos"><span class="text">Curso</span></label>
                            <div class="pull-right">
                                <a class="label label-warning">1000 Mt</a>
                                <a class="label label-default">500 Mt</a>
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
          
            <div class="box box-default">
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
                    {{--action="{{url('/salvar')}}--}}
                    <form id="form1" method="post">
                        {{csrf_field()}}
                        <button class="btn btn-danger" type="button">Cancelar</button>
                        <div class="pull-right">
                            <input type="hidden" id="valorP" name="valor" value="5000">
                            <input type="hidden" value="numerico" name="forma" >
                            <input type="hidden" value="123245" name="numrecibo">
                            <input type="hidden" value="2017-09-09 00:00:00" name="dataP">
{{--//                            data: {'valorTotal':valorPorMes,'estado':'pago','mes':meses[c], 'anoPago': '2017','idPagamento':10,'idAluno': idAluno, 'curso': curso},--}}

                            {{--Para Mensalidade--}}

                            {{--<input type="hidden" id="valorAPagar">--}}
                            <input type="hidden" id="valorMensal" name="valorTotal">
                            <input type="hidden" id="estado" name="estado" value="pago">
                            <input type="hidden" id="mes" name="mes">
                            <input type="hidden" id="anoPago" name="anoPago" value="2017">
                            <input type="hidden" id="idMensalidade" name="idMensalidade" value="1">
                            <input type="hidden" id="idPagamento" name="idPagamento" value="4">
                            <input type="hidden" id="idAluno" name="idAluno">
                            <input type="hidden" id="nomeCurso" name="curso">

                            <input id="butSalvar" value="Salvar" type="submit" class="btn btn-success">
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

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                }
            });

            $('.select2').select2();
            var valorMensal=0;
            var valorDivida=0;
            var idAluno=0;
            $('#inPutAluno').on('change',function () {
                $('#divFoto').addClass('collapsed-box').slideUp();

                var op = $('option[value="'+$(this).val()+'"]');
                idAluno = op.length ? op.attr('id'):'';
                if(idAluno === '' ||  $('#inPutAluno').val().length=== 0){
                    return;
                }
                var mesess='';

                $.ajax({
                    url: '/api/listarPorAluno',
                    type: 'POST',
                    data: {'idAluno':idAluno,'ano':2017,'curso':'n'},
                    success: function (rs) {
                        document.getElementById('idAluno').value = idAluno;
//                        alert(rs.mensalidade[0].mesEstado);
                        document.getElementById('fotoCaminho').value =  '{{asset('img/upload/')}}'.concat('/' + rs.inscricao[0].picture);
                        $('.cr').remove();
                        $('.mes').remove();
                        $('#actual').remove();
                        $('.ms').remove();

                        for(var cr =0; cr < rs.inscricao.length; cr++) {

                            var idCurso = rs.inscricao[cr].id;
                            var nomeCurso0 = rs.inscricao[0].nome;
                            var nomeCurso = rs.inscricao[cr].nome;
                            var valorMensal = rs.inscricao[cr].valormensal;
                            var valorMensal0 = rs.inscricao[0].valormensal;

                            $('#listCursos').append('<li class="cr"> ' +
                                '<input name="ckeque" class="radios" id="radio' + idCurso + '" type="checkbox" data-title="'+nomeCurso+'" data-valorMensal="'+valorMensal+'"  > <label for="radio' + idCurso + '"><span class="text">' + nomeCurso + '</span>' + '</label> ' +
                                '<a style="font-size:14px; float:right; width: 100px" class="label label-default">' + valorMensal.toFixed(2) + ' Mt</a> ' +
                                '<a id="dev'+idCurso+'" style="font-size:14px; float:right; width: 100px" class="label label-warning"></a> ' +
                            '</li>');

                            document.getElementById('nomeCurso').value=nomeCurso;
                            for (var men = 0; men < rs.mensalidade.length; men++) {
                                /*Quandod fez adiantados*/
//                                                        alert(rs.mensalidade[men].mesEstado);

                                if (valorMensal !== rs.mensalidade[men].valorTotal && (nomeCurso === rs.mensalidade[men].curso)) {
                                    valorDivida = valorMensal - rs.mensalidade[men].valorTotal;
                                    document.getElementById('radio' + idCurso+'').setAttribute('data-valorAdiantado',rs.mensalidade[men].valorTotal);
                                    document.getElementById('dev' + idCurso+'').innerHTML = parseFloat(rs.mensalidade[men].valorTotal).toFixed(2)+' Mt';
                                    document.getElementById('valorDivida').value=valorDivida;
                                }else {
                                    document.getElementById('valorDivida').value=0;
                                }
                                document.getElementById('txtValorAPagar').innerHTML = (valorMensal).toFixed(2) + ' ' + 'Mt';
                                document.getElementById('valorMensal').value = valorMensal;
                                document.getElementById('valorP').value = (valorMensal);
                            }
                        }
                        var grpx = 'input:checkbox[ data-title="'+nomeCurso+'"]';
                        $(grpx).prop("checked",true);

                        /*raking*/

                        getDivida(idAluno,nomeCurso,2017);

                        $('.radios').click(function () {

                            var valorMensal = parseFloat($(this).attr('data-valorMensal'));//valor Mensal do curso
                            var valorAdiantando = parseFloat($(this).attr('data-valorAdiantado'));//valor de adiantado do mes
                            if(valorAdiantando >0){
                                document.getElementById('valorDivida').value=valorMensal-valorAdiantando;
                                document.getElementById('txtValorAPagar').innerHTML = (valorMensal-valorAdiantando).toFixed(2)+ ' ' + 'Mt';
                                document.getElementById('valorP').value = (valorMensal-valorAdiantando);
                            }else{
                                document.getElementById('valorDivida').value=0;
                                document.getElementById('txtValorAPagar').innerHTML = (valorMensal).toFixed(2)+ ' ' + 'Mt';
                                document.getElementById('valorP').value = (valorMensal);
                            }
                            document.getElementById('valorMensal').value = valorMensal;

                            var curs = $(this).attr('data-title');//nome do curso
                            var box =$(this);
                            document.getElementById('nomeCurso').value=curs;
                            if(box.is(':checked')){
                                var grp = "input:checkbox[name='"+box.attr("name")+"']";
                                $(grp).prop("checked",false);
                                box.prop('checked',true);
                                document.getElementById('nomeCurso').value = curs;
                                $('.mes').remove();
                                $('#actual').remove();
                                $('.ms').remove();
                                getDivida(idAluno,curs,2017);
                            }else{
                                box.prop('checked',true);
                            }
                        });
                    }
                });
            });

            function getDivida(idAluno, curso, ano) {
                $.ajax({
                    url: '/api/getMeses',
                    type: 'POST',
                    data: {'idAluno': idAluno, 'curso': curso, 'ano': ano},
                    success: function (dados) {
                        var mesess = ''; var control=0;
                        for (var m = 0; m < dados.meses.length; m++) {
//                            alert(dados.meses[m].mes);
                            /*Quando nao fez adiantamento*/
                            if (dados.meses[m].estado === 'pago') {
                                $('#DivMeses').append(' <div class="mes"><label class="label label-success">' + dados.meses[m].mes + '</label></div>');
                                mesess += dados.meses[m].mes + ' ' + '<i style="color: #33de0c" class="fa fa-check"></i><br/>';
                                $('.label-warning').addClass('hidden');
                            } else {
                                /*quando fez adiantamento*/
                                control =1;
                                $('.label-warning').removeClass('hidden');
                                document.getElementById('mesAdiantado').value = dados.meses[m].mes;
                                $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + dados.meses[m].mes + '>' + dados.meses[m].mes + '</option>');
                                $('#DivMeses').append(' <div class="mes"><label class="label label-warning">' + dados.meses[m].mes + '</label></div>');
                            }
                        }
                        if(control ===0) {
                            document.getElementById('mesAdiantado').value =  dados.mesdAno[0].nome;
                            $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + dados.mesdAno[0].nome + '>' + dados.mesdAno[0].nome + '</option>');
                        }else{
                            $('#selectMes').append('<option   class="ms" value=' + dados.mesdAno[0].nome + '>' + dados.mesdAno[0].nome + '</option>');
                        }
                        $('#DivMeses').append('<div id="actual" class="tooltippy">' + '<p style="color:#3a5fff" class="centered"><i  class="fa fa-check fa-2x"></i></p><span class="tooltippytext">' + mesess + '</span> </div>');
                        for (var m2 = 0; m2 < dados.mesdAno.length; m2++) {
                            $('#DivMeses').append(' <div class="mes"><label class="label label-danger">' + dados.mesdAno[m2].nome + '</label></div>');
                            if((m2+1)<dados.mesdAno.length) {
                                $('#selectMes').append('<option  class="ms" value=' + dados.mesdAno[m2+1].nome + '>' + dados.mesdAno[m2 + 1].nome + '</option>');
                            }
                        }
                        $('#DivMeses').addClass('hidden').slideUp();
                        $('#DivMeses').removeClass('hidden').slideDown();
                        document.getElementById('idFotoAluno').src = document.getElementById('fotoCaminho').value;
                        $('#divFoto').removeClass('collapsed-box').slideDown();
                        document.getElementById('mes').value=  dados.mesdAno[0].nome;
                    }
                });
            }

            $('#selectMes').change(function () {
                var mesAdiantado = document.getElementById('mesAdiantado').value;
                var valorAPay = parseFloat(document.getElementById('valorMensal').value);
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

            function actulizarInerface(curso) {
                $('.mes').remove();
                $('#actual').remove();
                $('.ms').remove();
                getDivida(idAluno,curso,2017);
            }
            $('#form1').submit(function (exx) {
                exx.preventDefault();

                var valorMensal = parseFloat(document.getElementById('valorMensal').value);
                var meses = $('#selectMes').val();
                var valorAPagar = parseFloat(document.getElementById('valorP').value);
                var valorDivida = parseFloat(document.getElementById('valorDivida').value);
                var curso = document.getElementById('nomeCurso').value;
                var tipoPay = document.querySelector('input[name="tipoPay"]:checked').value;
                var formaPay = document.querySelector('input[name="formaPay"]:checked').value;
////                alert('Meses: '+meses+'  Taku:'+valorAPagar+'  Divida:'+valrDivida+'  idAluo:'+idAluno+' curso:'+curso+'  tipo:'+tipoPay+'  forma:'+formaPay);

                if(tipoPay === 'Normal'){
                    var vp = $("input#valorPayy").val();
                    if(vp.length < 1 ){
                        $("input#valorPayy").css({"border": "1px solid #EE6464"});
                        return false;
                    }

                    $("input#valorPayy").keyup(function(){
                        if($(this).length > 0){
                            $(this).css({"border": "1px solid #F5F5F5"});
                        }
                    });
                }

                $.ajax({
                    url: '/salvarPagamento',
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (idPagamento) {
                        document.getElementById('idPagamento').value = idPagamento;
                        if(valorDivida !== 0){
                            valorAPagar = valorAPagar-valorDivida;
                            $.ajax({
                                url: '/api/updateMensalidade',
                                type: 'POST',
                                data: {'idAluno': idAluno,'mes':meses[0], 'curso': curso, 'ano': '2017','valor':valorDivida},
                                success: function (rs) {
//                                    alert(rs);
                                    actulizarInerface(curso);
                                }
                            });
                        }
                    }
                });


                if(valorDivida !== 0) {
                    for (var c = 1; c < meses.length; c++) {
                        document.getElementById('mes').value= meses[c];
                        $.ajax({
                            url: '/salvarMensalidade',
                            type: 'POST',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (rs) {
//                                alert(rs);
                            }
                        });
                    }
                    actulizarInerface(curso);
                }else {
                    for (var x = 0; x < meses.length; x++) {
                        document.getElementById('mes').value = meses[x];
//                        alert('salva '+meses[x]);
                        $.ajax({
                            url: '/salvarMensalidade',
                            type: 'POST',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (rs) {
                                alert(rs);
                            }
                        });
                    }
                    actulizarInerface(curso);
                }
            });
        });
    </script>
@endsection



{{--for(var c=0; c< meses.length; c++){--}}
{{--document.getElementById('mes').value= meses[c];--}}
{{--if(valorDivida !== 0){--}}
{{--valorAPagar = valorAPagar-valorDivida;--}}
{{--$.ajax({--}}
{{--url: '/api/updateMensalidade',--}}
{{--type: 'POST',--}}
{{--data: {'idAluno': idAluno,'mes':meses[0], 'curso': curso, 'ano': '2017','valor':valorDivida},--}}
{{--success: function (rs) {--}}
{{--alert(rs);--}}
{{--}--}}
{{--});--}}
{{--valorDivida =0;--}}
{{--}else{--}}
{{--$.ajax({--}}
{{--url: '/salvarMensalidade',--}}
{{--type: 'POST',--}}
{{--data: new FormData(this),--}}
{{--processData: false,--}}
{{--contentType: false,--}}
{{--cache: false,--}}
{{--success: function (rs) {--}}
{{--alert(rs);--}}
{{--}--}}
{{--});--}}
{{--}--}}