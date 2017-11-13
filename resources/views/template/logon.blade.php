<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Fader Azevedo">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Login</title>

        <link href="{!! asset('css/bootstrap.css')!!}" rel="stylesheet">
        <link href="{!! asset('font-awesome/css/font-awesome.css')!!}" rel="stylesheet" />

        <link href="{!! asset('css/style.css')!!}" rel="stylesheet">
        <link href="{!! asset('css/style-responsive.css')!!}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{!! asset('css/normalize.css')!!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/materialize.min.css')!!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/material-design-iconic-font.min.css')!!}"/>
    </head>

    <body>
        <div id="login-page">
            <div class="container">

                <form class="form-login">
                    <h2 class="form-login-heading">Login</h2>
                    <div class="login-wrap">
                        <div class="input-field">
                            <input id="UserName" type="text" class="validate">
                            <label for="UserName"><i class="zmdi zmdi-account"></i>&nbsp;Nome</label>
                        </div>

                        <div class="input-field">
                            <input id="password" type="password" class="validate">
                            <label for="password"><i class="zmdi zmdi-lock"></i>&nbsp;Password</label>
                        </div>
                        <label class="checkbox">
                                <span class="pull-right">
                                    <a data-toggle="modal" href="#myModal"> Esqueceste Password?</a>
                                </span>
                        </label>
                        <button class="btn btn-theme btn-block" type="submit"><a href="{{url('/')}}"><i class="zmdi zmdi-lock-open"></i> Login</a></button>
                        <hr>
                    </div>

                    <div aria-hidden="true" aria-labelledby="" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5 class="modal-title">Esqueceste Password ?</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Preenche com seu email para restaurar</p>
                                    <div class="input-field">
                                        <input id="email"  type="text" class="validate">
                                        <label for="email" ><i class="zmdi zmdi-email"></i>&nbsp;Email</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                    <button class="btn btn-theme" type="button">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="{!! asset('js/jquery.js')!!}"></script>
        <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
        <script src="{!! asset('js/materialize.min.js')!!}"></script>
        <script type="text/javascript" src="{!! asset('js/jquery.backstretch.min.js')!!}"></script>
        <script>
            $.backstretch("{!! asset('img/bag.jpg')!!}", {speed: 500});
        </script>

    </body>
</html>
