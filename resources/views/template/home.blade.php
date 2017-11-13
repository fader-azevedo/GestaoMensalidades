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
            <li><a href="{{'/mensalidade/registar'}}"><i class="fa fa-pencil"></i> Registar Mensalidade</a></li>
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
            <li><a href="#"><i class="fa fa-home"></i>&nbsp; Inicio</a></li>
        </ol>
    </section>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Pagamento do Mes</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
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

                <p>Alunos Incritos</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
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
                    <div class="chart" id="bar-chart"  style="height:290px">
                        {{--<canvas id="barChart" style="height:290px"></canvas>--}}
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
                            {label: "Pagemtos", value: arr[1]},
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

//            var bar = new Morris.Bar({
//                element: 'bar-chart',
//                resize: true,
//                data: [
//                    {y: 'Janeiro', a: 100, b: 90},
//                    {y: 'Fevereiro', a: 75, b: 65},
//                    {y: 'Março', a: 50, b: 40},
//                    {y: '2009', a: 75, b: 65},
//                    {y: '2010', a: 50, b: 40},
//                    {y: '2011', a: 75, b: 65},
//                    {y: '2012', a: 100, b: 90}
//                ],
//                barColors: ['#00a65a', '#f56954'],
//                xkey: 'y',
//                ykeys: ['a', 'b'],
//                labels: ['Feito', 'Divida'],
//                hideHover: 'auto'
//            });

            /*Alunos*/




//            var chart = Morris.Bar({
//
//                ele
//            });

//            var areaChartData ={};
            {{--$.ajax({--}}
                {{--url: '/api/getlist',--}}
                {{--type: 'POST',--}}
                {{--success: function (data) {--}}
                    {{--for (var i = 0; i < data.length; i++) {--}}
                    {{--}--}}
                    {{--var areaChartData = {--}}
                         {{--labels: ['January', 'February', 'March', 'April', 'May', 'Junho', 'July', 'Agosto'],--}}
{{--//                        labels: [data.meses[1], data.meses[2], data.meses[3]],--}}
{{--//                        labels: [data.meses],--}}
                        {{--datasets: [--}}
                            {{--{--}}
                                {{--label: 'Electronics',--}}
                                {{--fillColor: 'rgba(210, 214, 222, 1)',--}}
                                {{--strokeColor: 'rgba(210, 214, 222, 1)',--}}
                                {{--pointColor: 'rgba(210, 214, 222, 1)',--}}
                                {{--pointStrokeColor: '#c1c7d1',--}}
                                {{--pointHighlightFill: '#fff',--}}
                                {{--pointHighlightStroke: 'rgba(220,220,220,1)',--}}
                                {{--data: [50, 29, 40, 21, 56, 55, 40, 11]--}}
                            {{--},--}}
                            {{--{--}}
                                {{--label: 'Digital Goods',--}}
                                {{--fillColor: 'rgba(60,141,188,0.9)',--}}
                                {{--strokeColor: 'rgba(60,141,188,0.8)',--}}
                                {{--pointColor: '#3b8bba',--}}
                                {{--pointStrokeColor: 'rgba(60,141,188,1)',--}}
                                {{--pointHighlightFill: '#fff',--}}
                                {{--pointHighlightStroke: 'rgba(60,141,188,1)',--}}
                                {{--data: [28, 48, 40, 19, 46, 27, 30, 40]--}}
                            {{--}--}}
                        {{--]--}}
                    {{--};--}}

{{--//                    areaChartData.setData(data.meses);--}}

                    {{--var barChartCanvas = $('#barChart').get(0).getContext('2d');--}}
                    {{--var barChart = new Chart(barChartCanvas);--}}
                    {{--var barChartData = areaChartData;--}}
                    {{--barChartData.datasets[1].fillColor = '#00a65a';--}}
                    {{--barChartData.datasets[1].strokeColor = '#00a65a';--}}
                    {{--barChartData.datasets[1].pointColor = '#00a65a';--}}
                    {{--var barChartOptions = {--}}
                        {{--//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value--}}
                        {{--scaleBeginAtZero: true,--}}
                        {{--//Boolean - Whether grid lines are shown across the chart--}}
                        {{--scaleShowGridLines: true,--}}
                        {{--//String - Colour of the grid lines--}}
                        {{--scaleGridLineColor: 'rgba(0,0,0,.05)',--}}
                        {{--//Number - Width of the grid lines--}}
                        {{--scaleGridLineWidth: 1,--}}
                        {{--//Boolean - Whether to show horizontal lines (except X axis)--}}
                        {{--scaleShowHorizontalLines: true,--}}
                        {{--//Boolean - Whether to show vertical lines (except Y axis)--}}
                        {{--scaleShowVerticalLines: true,--}}
                        {{--//Boolean - If there is a stroke on each bar--}}
                        {{--barShowStroke: true,--}}
                        {{--//Number - Pixel width of the bar stroke--}}
                        {{--barStrokeWidth: 2,--}}
                        {{--//Number - Spacing between each of the X value sets--}}
                        {{--barValueSpacing: 5,--}}
                        {{--//Number - Spacing between data sets within X values--}}
                        {{--barDatasetSpacing: 1,--}}
                        {{--//String - A legend template--}}
                        {{--legendTemplate          : '<ul class='<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',--}}
                        {{--//Boolean - whether to make the chart responsive--}}
                        {{--responsive: true,--}}
                        {{--maintainAspectRatio: true--}}
                    {{--};--}}

                    {{--barChartOptions.datasetFill = false;--}}
                    {{--barChart.Bar(barChartData, barChartOptions)--}}


                    {{--/*grafico de alunos*/--}}

                {{--}--}}
            {{--});--}}
        })
    </script>
@endsection