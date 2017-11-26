@extends('template.app')
@section('menu')
     <li class="treeview active">
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
            <li><a href="#"><i class="fa fa-home"></i>&nbsp; Inicio</a></li>
        </ol>
    </section>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$numTurma}}<sup style="font-size: 20px"></sup></h3>
                <p>Turmas</p>
            </div>
            <div class="icon">
                <i class="ion ion-clipboard"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$numAlunos}}</h3>

                <p>Incrições</p>
            </div>
            <div class="icon">
                <i class="ion ion-edit"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue-gradient">
            <div class="inner">
                <h3>{{$numCursos}}</h3>
                <p>Cursos</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-book"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$numDisc}}</h3>
                <p>Disciplinas</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-bookmark"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="row">
        <section class="col-lg-9 connectedSortable">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Pagamento de Mensalidades</h3>

                </div>
                <div class="box-body">
                    <h5 class="centered"><label class="label" style="background-color: #00a65a">Pagas</label>
                        <label class="label" style="background-color: #f56954">Nao Pagas</label></h5>
                    <div class="chart" id="bar-chart"  style="height:290px">
                    </div>
                </div>
            </div>
        </section>

        <section class="col-lg-3 connectedSortable">
            <div class="box box-danger">
                <div class="box-header with-border">

                    <i style="color: #00a65a" class="fa fa-money"></i>
                    <h3 style="color: #00a65a" class="box-title">Pagamento</h3>
                    <i class="fa fa-times"></i>
                    <i style="color: red" class="fa fa-money"></i>
                    <h3 style="color: red" class="box-title">Dividas</h3>

                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="payVSdivida" style="height: 300px;"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /*Mensalidades*/
            $.ajax({
                url: '/api/graficoMensalidade',
                type: 'POST',
                success: function (data) {
                    var arr = data.split('$&');
                    bar.setData(JSON.parse(arr[0]));

                    new Morris.Donut({
                        element: 'payVSdivida',
                        resize: true,
                        colors: ["#00a65a", "#f56954", "#00a65a"],
                        data: [
                            {label: "Pagemetos", value: arr[1]},
                            {label: "Dívidas", value: arr[2]}
                        ],
                        hideHover: 'auto'
                    });
                }
            });
            var bar =  Morris.Bar({
                element: 'bar-chart',
                resize: true,
                barColors: ['#00a65a', '#f56954'],
                xkey: 'mes',
                ykeys: ['naoDevs','devs'],
                labels: ['Concluido','Não concluido'],
                hideHover: 'auto'
            });
        })
    </script>
@endsection