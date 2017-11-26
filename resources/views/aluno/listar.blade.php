@extends('template.app')

@section('menu')

    <li>
        <a href="{{url('/')}}">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Mensalidades</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{'/mensalidade/registar'}}"><i class="fa fa-pencil"></i> Registar Mensalidades</a></li>
            <li><a href="{{'/mensalidade'}}"><i class="fa fa-list"></i> Listar Mensalidades</a></li>
        </ul>
    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Alunos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-pencil"></i> Registar Alunos</a></li>
            <li class="active"><a href=""><i class="fa fa-list"></i> Listar Alunos</a></li>
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
            <li><a href="#"><i class="fa fa-money"></i>&nbsp; Alunos</a></li>
            <li class="active">Lista</li>
        </ol>
    </section>

    <section class="row" style="padding-top: 14px">
        <div class="col-sm-7 col-md-7 col-lg-7">
            <div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="zmdi zmdi-search prefix"></i>
                        <input placeholder="Pesquisar" id="txtPesquisar" type="text" class="validate" onkeyup="filtrar()">
                        {{--<label for="first_name">First Name</label>--}}
                    </div>
                    <div class="input-field col s6">
                        <i class="zmdi zmdi-calendar prefix"></i>
                        <input placeholder="Ano" id="txtAno" type="text">
                        {{--<label for="first_name">First Name</label>--}}
                    </div>
                </div>
            </div>
            <table class="table-striped" id="tabela1">
                <thead>
                <tr>
                    <th >Código</th>
                    <th >Apelido</th>
                    <th >Nome</th>
                    <th >Sexo</th>
                    <th >Data Nasc</th>
                </tr>
                </thead>
                <tbody id="tabela1Corpo">
                @foreach($listaAluno  as $ms)
                    <tr>
                        <td class="">{{$ms->codigo}}</td>
                        <td class="">{{$ms->apelido}}</td>
                        <td class="">{{$ms->nome}}</td>
                        <td class="">{{$ms->sexo}}</td>
                        <td class="">{{$ms->dataNasc}}</td>

                        <td><a class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td><a class="btn btn-danger"><i class="zmdi zmdi-delete"></i>&nbsp;</a></td>
                        <td><a class="btn btn-info btn-ver" data-id="{{$ms->id}}"><i class="zmdi zmdi-eye"></i>&nbsp;</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5">
            <div class="box box-widget widget-user" style="display: flex; padding: 5px; background-color: #f5f5f5;">
                <div class="col-sm-9 text-center" id="divFoto" style="margin-left: -20px">
                    <img id="idFoto" class="img-rounded" src="{!! asset('img/user.jpg') !!}" alt="" height="150"><br/><br/>
                    <h6 style="margin: -10px 0 0 1px; font-size: 19px" class=" label-default" id="nomeAluno">Nome</h6>
                </div>
                <div class="col-sm-12 box" style="padding: 2px">
                    <ul class="todo-list" id="contacto">

                        <li class="" style="margin-bottom: 5px">
                            <span class="handle">
                                <i class="fa fa-location-arrow"></i>
                            </span>
                            <span class="text">Rua Costa do Sol</span>
                            <div class="tools">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                        </li>

                        <li class="cont" style="margin-bottom: 5px">
                            <span class="handle">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="text">12345678</span>
                            <div class="tools">
                                <i class="fa fa-phone"></i>
                            </div>
                        </li>
                        <li class="cont">
                            <span class="handle">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="text">soNos@gamil.com</span>
                            <div class="tools">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cursos</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="todo-list" id="curso">
                            <li class="crs">
                                    <span class="handle">
                                        <i class="fa fa-book"></i>
                                    </span>
                                <span class="text">Cursos</span>
                                <div class="tools2">
                                    <button class="btn btn-xs">Mais Detalhes</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.btn-ver').click(function () {
            var idAluno = $(this).attr('data-id');
            $.ajax({
                url: '/api/getInscricao',
                type: 'POST',
                data: {'idAluno': idAluno,'ano':2017},
                success: function (rs) {
                    $('.cont').remove();
                    $('.crs').remove();
                    $('#divFoto').addClass('collapsed-box').slideUp();
                    $('#curso').addClass('collapsed-box').slideUp();
                    $('#contacto').addClass('collapsed-box').slideUp();
                    for(var i =0; i < rs.inscricao.length; i++){
                        document.getElementById('nomeAluno').innerHTML = rs.inscricao[i].nome+' '+rs.inscricao[i].apelido;
                        $('#curso').append('<li class="crs" style="margin-bottom: 3px"> <span class="handle"> <i style="color: #00a7d0;" class="fa fa-book"></i> </span> <span class="text">'+rs.inscricao[i].curso+'</span> <div class="tools"> <i class="fa fa-eye"></i> </div> </li>')
                    }
                    $('#contacto').append('<li class="cont" style="margin-bottom: 5px"> <span class="handle"><i class="fa fa-phone"></i> </span> <span class="text">'+rs.inscricao[0].telefone+'</span> <div class="tools"> <i class="fa fa-phone"></i> </div> </li>');
                    $('#contacto').append('<li class="cont"> <span class="handle"><i class="fa fa-envelope"></i> </span> <span class="text">'+rs.inscricao[0].email+'</span> <div class="tools"> <i class="fa fa-envelope"></i> </div> </li>');
                    document.getElementById('idFoto').src =  '{{asset('img/upload/')}}'.concat('/' + rs.inscricao[0].picture);
                    $('#divFoto').removeClass('collapsed-box').slideDown();
                    $('#curso').removeClass('collapsed-box').slideDown();
                    $('#contacto').removeClass('collapsed-box').slideDown();
                }
            });
        });

        function filtrar() {

            var input = document.getElementById("txtPesquisar");
            var tabela = document.getElementById("tabela1");
            var linhas = tabela.getElementsByTagName("tr");

            for (var indice = 0; indice < linhas.length; indice++) {
                var coluna = linhas[indice].getElementsByTagName("td")[1];
                if (coluna) {
                    if (coluna.innerHTML.toLowerCase().indexOf(input.value.toLowerCase()) > -1) {
                        linhas[indice].style.display = "";
                    } else {
                        linhas[indice].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection