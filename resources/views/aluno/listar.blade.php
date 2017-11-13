@extends('template.app')

@section('menu')
    <li class="mt">
        <a href="{{url('/')}}">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-money"></i>
            <span>Mensalidades</span>
        </a>
        <ul class="sub">
            <li><a  href="{{url('/mensalidade')}}">Todas Mensalidades</a></li>
            <li><a  href="">Buttons</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a class="active" href="javascript:;" >
            <i class="fa fa-users"></i>
            <span>Alunos</span>
        </a>
        <ul class="sub">
            <li class="active"><a  href="{!! url('/aluno') !!}">Todos</a></li>
            <li><a  href="">Inscritos</a></li>
            <li><a  href="">Não Inscritos</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-history"></i>
            <span>Historico</span>
        </a>
        <ul class="sub">
            <li><a  href="">Aluno</a></li>
            <li><a  href="">Todos</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class=" fa fa-bar-chart-o"></i>
            <span>Estatísticas</span>
        </a>
        <ul class="sub">
            <li><a  >Graficos</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class=" fa fa-book"></i>
            <span>Extras</span>
        </a>
        <ul class="sub">
            <li><a>Lock</a></li>
        </ul>
    </li>

@endsection
@section('content')

    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>11 Hours Ago</muted><br/>
                <a href="#">Mark Twain</a> commented your post.<br/>
            </p>
        </div>
    </div>
@endsection