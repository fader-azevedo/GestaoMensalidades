@extends('template.app')
@section('menu')
    <li>
        <a href="{{url('/')}}">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
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
            <li><a href="{{'/mensalidade/registar'}}"><i class="fa fa-pencil"></i> Registar Mensalidade</a></li>
            <li class="active"><a href=""><i class="fa fa-list"></i> Listar Mensalidade</a></li>
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
            <li><a href=""><i class="fa fa-pencil"></i> Registar Aluno</a></li>
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
            <li><a href="#"><i class="fa fa-money"></i>&nbsp; Mensalidade</a></li>
            <li class="active">Lista</li>
        </ol>
    </section>

    <div class="nav-tabs-custom" style="background-color: #f2f2f2">
        <ul class="nav nav-tabs ">
            <li class="pull-left active"><a data-slide-to="0" href="#carousellDiv" data-toggle="tab"><i style="color: #00a7d0" class="fa fa-list"></i>&nbsp;Todas</a></li>
            <li><a class="" data-slide-to="1" href="#carousellDiv" data-toggle="tab"><i style="color: #59c0d0" class="fa fa-user"></i>&nbsp;Por Aluno</a></li>
            <li style="width: 100px;">
                <div >
                    <a class="myIcon"><i class="zmdi zmdi-calendar"></i></a>
                    <select class="material-control2"  id="selectAno">
                        @foreach($anos as $ano)
                            <option value="{{$ano}}">{{$ano}}</option>
                        @endforeach
                    </select>
                </div>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Morris chart - Sales -->
            <div id="carousellDiv" class="carousel slide" data-ride="carousel" data-interval="false">
                <div  class="carousel-inner">
                    <div class="item active">
                        <section class="col-sm-7 col-md-7 col-lg-7" style="padding-top: 14px">
                            <table class="table-striped" id="tabela1">
                                <thead>
                                    <tr>
                                        <th >Mês</th>
                                        <th >Não Devedores</th>
                                        <th >Devedores</th>
                                    </tr>
                                </thead>
                                <tbody id="tabela1Corpo">
                                    @foreach($mesesPagos  as $ms)
                                        <tr>
                                            <td class="">{{$ms->mes}}</td>
                                            <td><a data-mes="{{$ms->mes}}" class="btn btn-info btn-nao-devedor"><i class="fa fa-check"></i>&nbsp;{{\App\PagamntoMensalidade::query()->where('mes',$ms->mes)->count()}}</a></td>
                                            <td><a data-mes="{{$ms->mes}}" class="btn btn-danger btn-devedor"><i class="zmdi zmdi-close"></i>&nbsp;{{\App\Inscricao::query()->where('estado','=','inscrito')->count()-\App\PagamntoMensalidade::query()->where('mes',$ms->mes)->count()}}</a></td>
                                            <td><a data-mes="{{$ms->mes}}" class="btn btn-primary btn-detalhes" data-code="1"><i class="zmdi zmdi-library"></i>&nbsp;Mais detalhes </a></td>
                                        </tr>
                                    @endforeach

                                    @foreach($mesesAPagar as $ot)
                                        <tr>
                                            <td>{{$ot}}</td>
                                            <td><a disabled="disabled" class="btn btn-default"><i class="fa fa-check"></i>&nbsp;0</a></td>
                                            <td><a disabled="disabled" class="btn btn-default"><i class="zmdi zmdi-close"></i>&nbsp;{{\App\Inscricao::query()->where('estado','=','inscrito')->count()}}</a></td>
                                            <td><a disabled="disabled" class="btn btn-default"><i class="zmdi zmdi-library"></i>&nbsp;&nbsp;Sem registo&nbsp;&nbsp;</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                        <section class=" col-sm-5 col-md-5 col-lg-5 ">
                            {{--tabela Nao Devedores--}}
                            <div class="box box-info" id="boxNaoDevedor" style="position: relative">
                                <div class="box-header with-border">
                                    <h3 style="color: #00c0ef" class="box-title"><i class="fa fa-users"></i>&nbsp;Alunos não Devedores</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h5 class="left"><i class="fa fa-calendar-o"></i>&nbsp;<label style="min-width: 60px; font-size: 14px" id="tiluloMesPago"></label></h5>

                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clipboard"></i>&nbsp;Exportar
                                            <span class="caret"></span>
                                            <span class="sr-only"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a style="cursor: pointer;" id="ExportExcelNaoDevedor"><i style="color: green" class="fa fa-file-excel-o"></i>Excel</a></li>
                                            <li class="divider"></li>
                                            <li ><a  style="cursor: pointer;" id="ExportPdfNaoDevedor"><i style="color: red" class="fa fa-file-pdf-o"></i>Pdf</a></li>
                                        </ul>
                                    </div>
                                    <table class="striped" id="tabelaNaoDevedores" >
                                        <thead>
                                            <tr>
                                                <th id="MesAnoNaoDivida" class="anoExport"></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 40%">Nome</th>
                                                <th style="width: 20%">Turma</th>
                                                <th style="width: 20%">Curso</th>
                                                <th style="width: 20%">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabelaCorpoNaoDevedor">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{--tabela de devedores--}}
                            <div class="box box-danger" id="boxDevedor">
                                <div class="box-header with-border">
                                    <h3 style="color: #dd4b39" class="box-title"><i class="fa fa-users"></i>&nbsp;Alunos Devedores</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body" >
                                    <h5 class="left"><i class="fa fa-calendar-o"></i>&nbsp;<label style="min-width: 60px; font-size: 14px" id="tiluloMesDivida"></label></h5>

                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clipboard"></i>&nbsp;Exportar
                                            <span class="caret"></span>
                                            <span class="sr-only"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a style="cursor: pointer;" id="ExportExcelDevedor"><i style="color: green" class="fa fa-file-excel-o"></i>Excel</a></li>
                                            <li class="divider"></li>
                                            <li><a style="cursor: pointer;" id="ExportPdfDevedor"><i style="color: red" class="fa fa-file-pdf-o"></i>Pdf</a></li>
                                        </ul>
                                    </div>
                                    <table class="striped" id="tabelaDevedores" >
                                        <thead>
                                            <tr>
                                                <th id="MesAnoDivida" class="anoExport"></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 35%">Nome</th>
                                                <th style="width: 20%">Turma</th>
                                                <th style="width: 25%">Curso</th>
                                                <th style="width: 20%">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabelaCorpoDevedores">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="item row">
                        @include('mensalidade.aluno')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-primary fade" id="ModalDetalhes" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="ModalDetalhesItems">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            /*Action de tabela de devedores*/
            $('#alertExport').hide();
            var ano = document.getElementById('selectAno').value;

            var arr = formatarData(new Date()).split('-');
            preencherAlunosDevedores(arr[1],arr[2]);

            /*Lista todos Devedores de um mes especifico */

            function preencherAlunosDevedores(mes, ano) {
                $('#boxNaoDevedor').addClass('collapsed-box').slideUp();
                $('#boxDevedor').removeClass('collapsed-box').slideDown();

                $.ajax({
                    url: '/api/getDevedoresMes',
                    type: 'POST',
                    data: {'mes': mes, 'ano': ano, 'tabela':'devedor','tipo':'naoModal'},
                    success: function (rs) {
                        if(rs.devedor.length<=0){
                            return;
                        }

                        $('.rm').remove();
                        document.getElementById('tiluloMesDivida').innerHTML = mes;
                        document.getElementById('MesAnoDivida').innerHTML = 'Alunos Devedores'+' '+mes+'-'+ano;
                        $('MesAnoDivida').slideDown();

                        for (var k = 0; k < rs.vezes; k++) {
                            $('<tr class="rm"><td>'+rs.devedor[k].nomeAluno+' '+ rs.devedor[k].apelido+'</td><td>'+rs.turma[k]+'</td><td>'+rs.cursos[k]+'</td><td>'+parseFloat(rs.valor[k]).toFixed(2)+' Mt'+'</td></tr>').hide().appendTo('#tabelaCorpoDevedores').fadeIn(1000);
                        }
                    }
                })
            }
            $('.btn-devedor').on('click', function(){
                var mes= $(this).attr('data-mes');
                preencherAlunosDevedores(mes,ano);
            });
            /*lista todos nao devedores*/
            $('.btn-nao-devedor').on('click', function () {

                $('#boxDevedor').addClass('collapsed-box').slideUp();
                $('#boxNaoDevedor').removeClass('collapsed-box').slideDown();

                var mes= $(this).attr('data-mes');
                $.ajax({
                    url: '/api/getDevedoresMes',
                    type: 'POST',
                    data: {'mes': mes, 'ano': ano, 'tabela':'naodevedor','tipo':'naoModal'},
                    success: function (rs) {
                        if(rs.naodevedor.length<=0){
                            return;
                        }

                        $('.rm2').remove();
                        document.getElementById('tiluloMesPago').innerHTML = mes;
                        document.getElementById('MesAnoNaoDivida').innerHTML = 'Alunos Nao Devedores'+' '+mes+'-'+ano;
                        $('MesAnoNaoDivida').slideDown();
                        for(var k =0; k < rs.naodevedor.length; k++){
                            $('<tr class="rm2"><td>'+rs.naodevedor[k].nomeAluno+' '+ rs.naodevedor[k].apelido+'</td><td>'+rs.naodevedor[k].turma+'</td><td>'+rs.naodevedor[k].curso+'</td><td>'+rs.naodevedor[k].valor+' Mt</td></tr>').hide().appendTo('#tabelaCorpoNaoDevedor').fadeIn(1000);
                        }
                    }
                })
            });

            /*Exportacao de tabela de devedores para excel e pdf*/
            $('#ExportExcelDevedor').click(function () {
                var rowCountDev = document.getElementById('tabelaCorpoDevedores').rows.length;
                if(rowCountDev <= 0){
                    $('#alertExport').slideDown();
                    return;
                }
                $('#tabelaDevedores').tableExport({type:'excel',escape:'false'});
            });

            $('#ExportPdfDevedor').click(function () {
                var rowCountDev = document.getElementById('tabelaCorpoDevedores').rows.length;
                if(rowCountDev <= 0){
                    $('#alertExport').slideDown();
                    return;
                }
                var mesDev =  document.getElementById('tiluloMesDivida').innerHTML;
                $.ajax({
                    url:'/api/exportarDevedores',
                    type:'POST',
                    data:{'mes':mesDev,'ano':ano}
                });
            });

            /*Exportacao de tabela no devedores para excel e pdf*/
            $('#ExportExcelNaoDevedor').click(function () {
                var rowCountDev = document.getElementById('tabelaCorpoNaoDevedor').rows.length;
                if(rowCountDev <= 0){
                    $('#alertExport').slideDown();
                    return;
                }
                $('#tabelaNaoDevedores').tableExport({type:'excel',escape:'false'});
            });

            $('#ExportPdfNaoDevedor').click(function () {
                var rowCountDev = document.getElementById('tabelaCorpoNaoDevedor').rows.length;
                if(rowCountDev <= 0){
                    $('#alertExport').slideDown();
                    return;
                }
                var mesPago =  document.getElementById('tiluloMesPago').innerHTML;
                $.ajax({
                    url:'/api/exportarNaoDevedores',
                    type:'POST',
                    data:{'mes':mesPago,'ano':ano}
                });
//                window.location ='/exportDevedoresPDF?mes='+mesPago+'&ano='+ano+'&tabela=naodevedor';
            });


            
            /*Mais detalhes*/
            $('.btn-detalhes').click(function () {
                var mes= $(this).attr('data-mes');

                $.ajax({
                    url: '/api/getDevedoresMes',
                    type: 'POST',
                    data: {'mes': mes, 'ano': ano, 'tabela':'todasTabelas','tipo':'simModel'},
                    success:function(data){
                        $('#ModalDetalhesItems').html(data);
                        $('#ModalDetalhes').modal({
                            show: true,
                            backdrop: "static"
                        });
                    }
                });
                return false;
            })

        });
    </script>
@endsection
