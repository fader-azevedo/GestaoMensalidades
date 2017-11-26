<div class="col-md-4 col-sm-4 col-lg-4">

    <div style="display: flex; padding-top: 5px; margin: 15px 0 8px 0; width: 100%">
        <a style="color: #3f729b; font-size: 33px; margin-top: -5px">
            <i class="zmdi zmdi-account-circle prefix"></i>
        </a>
        <select id="inPutAluno" class="select2" style="width: 1000px">
            <option selected="selected">Selecine o aluno</option>
            @foreach($alu  as $a)
                <option id="{{$a->id}}" value="{{$a->nome.' '.$a->apelido}}">{{$a->nome.' '.$a->apelido}}</option>
            @endforeach
        </select>
    </div>

    <div class="box box-widget widget-user" >
        <div class="widget-user-header bg-aqua-active">
            {{--<p class="centered">Nome</p>--}}
        </div>
        <div class="widget-user-image" id="divIMG">
            <img id="idPicture" class="img-circle" src="{!! asset('img/user.jpg') !!}" alt="">
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <div class="sm-st tooltipped" data-tooltip="Valor Pago">
                            <label class="label label-success">Pago</label>
                            <p class="centered">
                                <span class="sm-st-icon st-green"><i class="fa fa-money"></i></span>
                            </p>
                            <div class="sm-st-info centered">
                                <p id="valorPago">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <div class="sm-st  tooltipped"  data-tooltip="Divida">
                            <label class="label label-danger">Dívida</label>
                            <p class="centered">
                                <span class="sm-st-icon st-red"><i class="fa fa-money"></i></span>
                            </p>
                            <div class="sm-st-info centered">
                                <p id="valorDivida">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="description-block">
                        <div class="sm-st tooltipped" data-tooltip="Total a Pagar" >
                            <label class="label label-info">Total</label>
                            <p class="centered">
                                <span class="sm-st-icon st-blue"><i class="fa fa-money"></i></span>
                            </p>
                            <div class="sm-st-info centered">
                                <p id="txtValorTotal">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-122 col-sm-12 col-log-12" style="padding-bottom: 0">
                    <div class="progress progress-striped ">
                        <div id="barWidth" class="progress-bar tooltipped"  role="progressbar"   aria-valuemin="0" aria-valuemax="100" data-tooltip="% de Pagamento Feito">
                            <span class="centered" style="font-size: 13px;"  id="percPago"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8 col-sm-8 col-lg-8" id="divTabela2">

    <div style="margin-top: 19px;  display: flex" class="row">
        <div class="col-sm-4 col-md-4 col-lg-4" style="padding: 0">
            <select class="form-control " id="inputCurso" style="width: 100%">
            </select>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4"></div>
        <div class="btn-group col-sm-4 col-md-4 col-lg-4" style="padding: 0">
            <button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown"><i class="fa fa-clipboard"></i>&nbsp;Exportar
                <span class="caret"></span>
                <span class="sr-only"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a style="cursor: pointer;" id="ExportExcel2"><i style="color: green" class="fa fa-file-excel-o"></i>Excel</a></li>
                <li class="divider"></li>
                <li><a style="cursor: pointer;" id="ExportPdf2f"><i style="color: red" class="fa fa-file-pdf-o"></i>Pdf</a></li>
            </ul>
        </div>
    </div>

    <table id="tabela2" class="table-striped">
        <thead>
        <tr>
            <th>Mês</th>
            <th>Data de Pagamento</th>
            <th>Estado</th>
            <th>Valor Pago</th>
        </tr>
        </thead>
        <tbody id="tabela2Corpo">
        </tbody>
    </table>
    <input type="hidden" id="txtCurso">
</div>

@section('scripts2')
    <script>
        $('.select2').select2();

        /*buscar cursos de um aluno*/

        function preencherTable(idAluno, nomeCurso, ano) {
            $.ajax({
                url: '/api/listarPorAluno',
                type: 'POST',
                data: {'idAluno': idAluno, 'ano': ano,'curso':nomeCurso},
                success: function (rs) {

                    var valorPago =0; var valorMensal;
                    $('.tr').remove();
                    $('.ss').remove();
                    for (var j = 0; j < rs.mensalidade2.length; j++) {
                        if(nomeCurso ===rs.mensalidade2[j].curso) {
                            if(rs.mensalidade2[j].mesEstado === 'pago') {
                                $('#tabela2Corpo').append(" <tr class='tr'><td>" + rs.mensalidade2[j].mes + "</td> " +
                                    "<td>" + formatarData(new Date(rs.mensalidade2[j].created_at)) + "</td><td><label style='font-size: 14px' class='label label-success'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + rs.mensalidade2[j].mesEstado + "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-check'></i></label></td>" +
                                    "<td>" + rs.mensalidade2[j].valorTotal + "</td><td>" +
                                    "</tr>");
                                valorMensal = rs.mensalidade2[j].valorTotal;
                            }else{
                                $('#tabela2Corpo').append(" <tr class='tr'><td>" + rs.mensalidade[j].mes + "</td> " +
                                    "<td>" + formatarData(new Date(rs.mensalidade[j].created_at)) + "</td><td><label style='font-size: 14px' class='label label-warning'>" + rs.mensalidade2[j].mesEstado + "&nbsp;<i class='fa fa-times'></i></label></td>" +
                                    "<td>" + rs.mensalidade[j].valorTotal + "</td><td>" +
                                "</tr>");
                            }
                        }
                        valorPago += rs.mensalidade2[j].valorTotal;
                    }
                    var valorTotal = valorMensal * (intervalo + 1);
//                    var rk = document.getElementById('tabela2Corpo').rows.length;
                    var prc = (valorPago * 100) / valorTotal;
                    document.getElementById('txtValorTotal').innerHTML = valorTotal;
                    document.getElementById('valorPago').innerHTML = valorPago;
                    document.getElementById('valorDivida').innerHTML = valorTotal - valorPago;
                    document.getElementById('percPago').innerHTML = prc.toFixed(2) + '%';
                    document.getElementById('barWidth').style.width = prc + '%';

                    for(var n=0; n< rs.mesesNaoPagos.length;n++ ){
                        $('#tabela2Corpo').append(" <tr class='tr'><td>" + rs.mesesNaoPagos[n].nome + "</td> " +
                            "<td>" + formatarData(new Date()) + "</td><td><label style='font-size: 14px' class='label label-danger'>Não Pago&nbsp;<i class='fa fa-times'></i></label></td>" +
                            "<td>" + 0.00 + "</td><td>" +
                        "</tr>");
                    }
                }
            });
        }

        var intervalo = JSON.parse("{{json_encode($intervalo)}}");
        var idAluno=0;var ano;
        $('#inPutAluno').on('change',function () {

            ano = document.getElementById('selectAno').value;
            var op = $('option[value="'+$(this).val()+'"]');
             idAluno = op.length ? op.attr('id'):'';
            if(idAluno === '' ||  $('#inPutAluno').val().length=== 0){
                return;
            }
            $('#divIMG').addClass('collapsed-box').slideUp();
            $.ajax({
                url: '/api/getInscricao',
                type: 'POST',
                data: {'idAluno': idAluno, 'ano': ano},
                success: function (rs) {
                    if(rs.inscricao.length <=0){
                        return;
                    }
                    $('.crs').remove();
                    $('#inputCurso').append('<option id="' + rs.inscricao[0].idCurso + '" class="crs" selected value="' + rs.inscricao[0].curso + '">' + rs.inscricao[0].curso + '</option>');
                    for (var c = 1; c < rs.inscricao.length; c++) {
                        $('#inputCurso').append('<option class="crs"  value="' + rs.inscricao[c].curso + '">' + rs.inscricao[c].curso + '</option>');
                    }
                    preencherTable(idAluno,rs.inscricao[0].curso, ano);
                    document.getElementById('txtCurso').value = rs.inscricao[0].curso;

                    document.getElementById('idPicture').src = '{{asset('img/upload/')}}'.concat('/' + rs.inscricao[0].picture);
                    $('#divIMG').removeClass('collapsed-box').slideDown();
                }
            });

        });


        var nomeCurso;
        $('#inputCurso').on('change',function () {
            ano = document.getElementById('selectAno').value;
            var op = $('option[value="'+$(this).val()+'"]');
            nomeCurso = op.length ? op.attr('value'):'';
            document.getElementById('txtCurso').value = nomeCurso;
            preencherTable(idAluno,nomeCurso,ano)
        });

        function formatarData(date) {
            var meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

            var dia = date.getDate();
            var mesIndex = date.getMonth();
            var ano = date.getFullYear();
            return dia+'-'+meses[mesIndex]+'-'+ano;
        }

        $('#ExportExcel2').click(function () {
            var rowCountDev = document.getElementById('tabela2Corpo').rows.length;
            if(rowCountDev <= 0){
                return;
            }
            $('#tabela2').tableExport({type:'excel',escape:'false'});
        });

        $('#ExportPdf2f').click(function () {
            var curso = document.getElementById('txtCurso').value;
            window.location ='/exportAluno?idAluno='+idAluno+'&ano='+ano+'&curso='+curso+'';
        })

    </script>
@endsection