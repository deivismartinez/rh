<!DOCTYPE html>
<?php
require_once("../Tablero/vo/UsuarioVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    
} else {
    header("Location: ../Entrada.html");
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Inscripción Docente Unicesar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body>

        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

                <!--
            
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                    Tip 2: you can also add an image using data-image tag
            
                -->
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <img class="img-responsive" alt="UPC" src="../images/titulo.png">
                        </div>
                        <div class="collapse navbar-collapse">
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                    </div>
                   <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">TRATAMIENTO DE DATOS PERSONALES</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p align="justify">
                                            AUTORIZACIÓN DE TRATAMIENTO DE DATOS PERSONALES. De conformidad con el artículo 9 y 12 de la Ley 1581 de 2012 y los artículos 5 del Decreto 1377 de 2013, se solicita autorización expresa para el tratamiento de los datos personales, suministrados en el presente registro electrónico, informando que estos serán gestionados en una infraestructura informática controlada por la Universidad Popular del Cesar. Los datos personales serán tratados de manera confidencial y segura de acuerdo a la ley y su decreto reglamentario.  La Universidad Popular del Cesar queda autorizada para recolectar, almacenar, usar, confirmar, circular y suprimir los datos personales suministrados por usted y que se registren en las bases de datos de la Entidad.
Es de advertir que los datos especialmente protegidos, tales como datos sensibles, que hayan sido suministrados, cuentan con un nivel de seguridad alto y además se informa que las preguntas que se generen sobre este tipo de información sensible no son de respuesta obligatoria, garantizando los derechos constitucionales de privacidad, intimidad, igualdad y no discriminación.
Si está de acuerdo por favor hacer click en <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="seguir('inicio.php')">ACEPTAR.</a>
</p>
                                        </div>
                       <div align="center"><a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="seguir('inicio.php')"><h3><i class="pe-7s-check"></i>ACEPTAR</a></h3></p></div>
                   </div>
                </div>
            </div>
        </div>


    </body>

    <!--   Core JS Files   -->
    <script src="js/funciones.js"></script>

    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-notebook',
                message: "Por favor diligencie <b>Su información Académica</b>"

            }, {
                type: 'info',
                timer: 1000
            });

        });
    </script>

</html>
