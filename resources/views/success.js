/**
 * Created by Fader Azevedo on 11/18/2017.
 */
// document.getElementById('idFotoAluno').src = '{{asset('img/upload/')}}'.concat('/' + rs.foto);
$('.mes').remove();
$('#actual').remove();
$('.ms').remove();
/*Inicio de raking de pagamento*/
var mesAdiantado ='';

var valorTodosMeses =0;
var dividasTodosMeses =0;
if(rs.mensal.length > 0) {
    for (var i = 0; i < rs.mensal.length; i++) {
        if (rs.mensal[i].mesEstado === 'pago') {
            $('#DivMeses').append(' <div class="mes"><label class="label label-success">' + rs.mensal[i].mes + '</label></div>');
            mesess += rs.mensal[i].mes + ' ' + '<i style="color: #33de0c" class="fa fa-check"></i><br/>';
            document.getElementById('mesAdiantado').value='';
        } else if (rs.mensal[i].mesEstado === 'adiantado') {
            //valor adicantado
            $('#DivMeses').append(' <div class="mes tooltippy"> <span style="color:#f39c12;" class="tooltippytext">Valor:' + ' ' +(rs.curso[0].valormensal-rs.mensal[i].divida) + ' ' + 'Mt</span> <label class="label label-warning">' + rs.mensal[i].mes + '</label></div>');
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
            alert('um  curso '+ valorTodosMeses);
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
//                                        alert(valorTodosMeses);
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
//                                if(rs.mensal[i].divida > 0){
//                                    $('.label-warning').removeClass('hidden');
//                                }else{
//                                    $('.label-warning').addClass('hidden');
//                                }
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
//                        alert(valorTodosMeses);

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










$.ajax({
    url: '/api/getDividas',
    type: 'POST',
    data: {'idAluno': idAluno, 'curso': curs, 'ano': '2017'},
    success: function (rs2) {

        $('.mes').remove();
        $('#actual').remove();
        $('.ms').remove();
        mesAdiantado ='';
        var meses2 = '';
        for (var b = 0; b < rs2.mensal2.length; b++) {
            if (rs2.mensal2[b].mesEstado === 'pago') {
                $('#DivMeses').append(' <div class="mes"><label class="label label-success">' + rs2.mensal2[b].mes + '</label></div>');
                meses2 += rs2.mensal2[b].mes + ' ' + '<i style="color: #33de0c" class="fa fa-check"></i><br/>';
                document.getElementById('mesAdiantado').value =rs2.mensal2[b].mes;
                $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + rs2.mensal2[b].mes + '>' + rs2.mensal2[b].mes + '</option>');
                $('#selectMes').append('<option  selected="selected"  class="ms" value=' + rs2.situacao[0].nome + '>' + rs2.situacao[0].nome + '</option>');

            } else if (rs2.mensal2[b].mesEstado === 'adiantado') {
                $('#DivMeses').append(' <div class="mes tooltippy"> <span style="color:#f39c12;" class="tooltippytext">Valor:' + ' ' + rs2.mensal2[b].valorTotal + ' ' + 'Mt</span> <label class="label label-warning">' + rs2.mensal2[b].mes + '</label></div>');
                meses2 += rs2.mensal2[b].mes + ' ' + '<i style="color: #f39c12" class="fa fa-check"></i><br/>';
//                                                $('#selectMes').append('<option  selected="selected"  class="ms adiantado" value=' + rs2.situacao[0].nome + '>' + rs2.situacao[0].nome + '</option>');

                alert('adintado'+ rs2.situacao[0].nome);

            }
        }
//                                        if(mesAdiantado !== '') {
//                                            document.getElementById('mesAdiantado').value =mesAdiantado;
//                                        }else {
//                                            document.getElementById('mesAdiantado').value =rs2.situacao[0].nome;
//                                        }

        $('#DivMeses').append('<div id="actual" class="tooltippy">' + '<p style="color:#3a5fff" class="centered"><i  class="fa fa-check fa-2x"></i></p><span class="tooltippytext">' + meses2 + '</span> </div>');
        $('#DivMeses').append(' <div class="mes"><label class="label label-danger">' + rs2.situacao[0].nome + '</label></div>');
        for (var m = 1; m < rs2.situacao.length; m++) {
            $('#DivMeses').append(' <div class="mes"><label class="label label-danger">' + rs2.situacao[m].nome + '</label></div>');
            $('#selectMes').append('<option  class="ms" value='+rs2.situacao[m].nome+'>'+rs2.situacao[m].nome+'</option>');
        }
    }
});





//
// $.ajax({
//     url: '/api/getValorAdiantado',
//     type: 'POST',
//     data: {'idAluno':idAluno,'curso':rs.inscricao[cr].nome,'ano':2017},
//     success: function (valorAdiantado) {
//         if(valorAdiantado > 0){