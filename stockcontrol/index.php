<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="images/icon.png"/>

    <title>Orkidea StockControl</title>

<?php

session_start();
$_SESSION = array();
session_destroy();

include_once('useful.php');

//bootstrap core
includeCss('lib/bootstrap/css/bootstrap.min.css');
//MetisMenu
includeCss('lib/metisMenu/metisMenu.min.css');
//sb-admin 2
includeCss('dist/css/sb-admin-2.css');
//Font Awesome
includeCss('lib/font-awesome/css/font-awesome.min.css');

//jquery
includeJs('lib/jquery/jquery.min.js', $cached);
//Bootbox
includeJs('lib/bootbox/bootbox.min.js', $cached);

?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
    #logo-brasao {
        display: block;
        margin: 20px auto;
        width: 150px;
    }
</style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div id="div-logo-brasao" class="col-md-4 col-md-offset-4">
                <img id="logo-brasao" src="images/brasao.png">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Orkidea StockControl 1.0 Beta</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" id="user" type="input" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="senha" id="pass" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a id="btn-login" class="btn btn-lg btn-success btn-block">Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#btn-login').click(function(){
                $.post('model/authUser.php',{
                    'user':$('#user').val(),
                    'pass':$('#pass').val()
                }, function(res){
                    if(res == 'success') window.location = 'dash.php';
                    else bootbox.alert('Login invalido!');
                });
            });
        });
    </script>

<?php

//bootstrap core
includeJs('lib/bootstrap/js/bootstrap.min.js', $cached);
//metis menu
includeJs('lib/metisMenu/metisMenu.min.js', $cached);
//sb-admin 2
includeJs('dist/js/sb-admin-2.js', $cached);

?>

</body>

</html>
