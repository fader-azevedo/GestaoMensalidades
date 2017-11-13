<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Fader Azevedo">

        <title>Gestão de Mensalidades</title>
        <link href="{!! asset('css/bootstrap.css')!!}" rel="stylesheet">
        <link href="{!! asset('font-awesome/css/font-awesome.css')!!}" rel="stylesheet" />

        <link href="{!! asset('css/style.css')!!}" rel="stylesheet">
        <link href="{!! asset('css/style-responsive.css')!!}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{!! asset('css/normalize.css')!!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/materialize.min.css')!!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/material-design-iconic-font.min.css')!!}"/>
    </head>

    <body onload="getTime()">
        <div class="container">

            <div id="showtime"></div>
            <div class="col-lg-4 col-lg-offset-4">
                <div class="lock-screen">
                    <h2><a data-toggle="modal" href="#myModal"><i class="zmdi zmdi-lock-open"></i></a></h2>
                    <h6>Desbloquear</h6>
                    <!-- Modal -->
                        <div class="modal fade"  id="myModal"  role="dialog" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h5 class="modal-title">Bem Vindo</h5>
                                    </div>

                                    <div class="modal-body">
                                        <p class="centered"><img class="img-circle" width="80" src="{!! asset('img/logo.jpg')!!}"></p>
                                        <div class="input-field">
                                            <input id="vf"  type="password" class="validate">
                                            <label for="vf" ><span class="zmdi zmdi-lock-open"></span>&nbsp;Password</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button style="float: left" data-dismiss="modal" class="btn btn-danger" type="button">Cancelar</button>
                                        <button class="btn btn-theme" type="button"><a href="{{url('/')}}">Login</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- modal -->
                </div>
            </div>
        </div>

        <script src="{!! asset('js/jquery.js')!!}"></script>
        <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
        <script src="{!! asset('js/materialize.min.js')!!}"></script>
        <script type="text/javascript" src="{!! asset('js/jquery.backstretch.min.js')!!}"></script>
        <script>
            $.backstretch("{!! asset('img/bag.jpg')!!}", {speed: 500});
        </script>

        <script>
            function getTime() {
                var today=new Date();
                var h=today.getHours();
                var m=today.getMinutes();
                var s=today.getSeconds();
                var mm = today.getMilliseconds();
                // add a zero in front of numbers<10
                m=checkTime(m);
                s=checkTime(s);
                document.getElementById('showtime').innerHTML=h+":"+m+":"+s+'='+mm;
                t=setTimeout(function(){getTime()},500);
            }

            function checkTime(i) {
                if (i<10)
                {
                    i="0" + i;
                }
                return i;
            }
        </script>
    </body>
</html>
